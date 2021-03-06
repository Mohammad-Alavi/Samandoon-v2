<?php

namespace App\Containers\Repost\UI\API\Transformers;

use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\FindContentByIdTask;
use App\Containers\Repost\Models\Repost;
use App\Containers\Subject\UI\API\Transformers\SubjectTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Exceptions\Exception;
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
        $userTransformer = new UserTransformer();
        $subjectTransformer = new SubjectTransformer();

        /** @var FindContentByIdTask $findContentByIdTask */
        $findContentByIdTask = App::make(FindContentByIdTask::class);
        /** @var Content $referenced_content */
        try {
            $referenced_content = $findContentByIdTask->run($entity->referenced_content_id);

            $response = [
                'object' => 'Repost',
                'id' => $entity->getHashedKey(),
                'content_id' => Hashids::encode($entity->content_id),
                'referenced_content_id' => Hashids::encode($entity->referenced_content_id),
                'referenced_content_article_text' => $referenced_content->article->text,
                'referenced_content_subject' => $subjectTransformer->transform($referenced_content->subject),
                'referenced_content_user' => $userTransformer->transform($referenced_content->user),
                'referenced_content_created_at' => $referenced_content->created_at,
                'referenced_content_updated_at' => $referenced_content->updated_at,
            ];
        } catch (Exception $exception) {
            if ($exception->getStatusCode() == 404) {
                $response = [
                    'object' => 'Repost',
                    'id' => null,
                    'content_id' => Hashids::encode($entity->content_id),
                    'referenced_content_id' => null,
                    'referenced_content_article_text' => null,
                    'referenced_content_subject' => null,
                    'referenced_content_user' => null,
                    'referenced_content_created_at' => null,
                    'referenced_content_updated_at' => null,
                ];
            }
        }

//        $response = [
//            'object' => 'Repost',
//            'id' => $entity->getHashedKey(),
//            'content_id' => Hashids::encode($entity->content_id),
//            'referenced_content_id' => Hashids::encode($entity->referenced_content_id),
//            'referenced_content_count' => Repost::where('referenced_content_id', '=', $entity->referenced_content_id)->count(),
//            'referenced_content_user' => $userTransform->transform($referenced_content->user),
//            'referenced_content_article_text' => $referenced_content->article->text,
//            'referenced_content_created_at' => $referenced_content->created_at,
//            'referenced_content_updated_at' => $referenced_content->updated_at,
//        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
