<?php

namespace App\Containers\Image\UI\API\Transformers;

use App\Containers\Image\Models\Image;
use App\Ship\Parents\Transformers\Transformer;

class ImageTransformer extends Transformer
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
     * @param Image $entity
     *
     * @return array
     */
    public function transform(Image $entity)
    {
        $response = [
            'object' => 'Image',
            'id' => $entity->getHashedKey(),
            'image_url' => config('samandoon.storage_path') . str_replace(config('samandoon.storage_path_replace'), '', $entity->getFirstMediaUrl('image')),
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
