<?php

namespace App\Containers\Subject\UI\API\Transformers;

use App\Ship\Parents\Transformers\Transformer;
use Illuminate\Database\Eloquent\Collection;
use Vinkla\Hashids\Facades\Hashids;

class SubjectTransformer extends Transformer
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
     * @param Collection $entity
     *
     * @return array
     */
    public function transform(Collection $entity)
    {
        $entity = $entity->first();
        $response = [
            'object' => 'Subject',
            'id' => Hashids::encode($entity->id),
            'subject' => $entity->name,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
             'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
