<?php

namespace App\Containers\Image\Actions;

use App\Containers\Image\Models\Image;
use App\Containers\Image\Tasks\CreateImageTask;
use App\Ship\Parents\Actions\Action;

class CreateImageSubAction extends Action
{

    /**
     * @var CreateImageTask $createImageTask
     */
    protected $createImageTask;

    /**
     * CreateImageSubAction constructor.
     *
     * @param CreateImageTask $createImageTask
     */
    public function __construct(CreateImageTask $createImageTask)
    {
        $this->createImageTask = $createImageTask;
    }

    /**
     * @param array  $data
     * @param string $content_id
     *
     * @return Image
     */
    public function run(array $data, string $content_id): Image
    {
        $imageData = [
            'image' => $data['image'],
            'content_id' => $content_id,
        ];
        $image = $this->createImageTask->run($imageData);

        return $image;
    }
}
