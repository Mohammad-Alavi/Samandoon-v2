<?php

namespace App\Containers\Repost\UI\API\Transformers;

use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\FindContentByIdTask;
use App\Containers\Repost\Models\Repost;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Transformers\Transformer;
use Illuminate\Support\Facades\App;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class RepostTransformer
 *
 * @package App\Containers\Repost\UI\API\Transformers
 */
class RepostTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param Repost $entity
     *
     * @return array
     */
    public function transform(Repost $entity)
    {
        $userTransform = new UserTransformer();
        /** @var FindContentByIdTask $findContentByIdTask */
        $findContentByIdTask = App::make(FindContentByIdTask::class);
        /** @var Content $referenced_content */
        $referenced_content = $findContentByIdTask->run($entity->referenced_content_id);

        $response = [
            'object' => 'Repost',
            'id' => $entity->getHashedKey(),
            'content_id' => Hashids::encode($entity->content_id),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
            'referenced_content_id' => Hashids::encode($entity->referenced_content_id),
            'referenced_content_user' => $userTransform->transform($referenced_content->user),
            'referenced_content_article_text' => $referenced_content->article->text

        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
