<?php

namespace App\Containers\Image\Tasks;

use App\Containers\Image\Data\Repositories\ImageRepository;
use App\Containers\Image\Models\Image;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Request;

class CreateImageTask extends Task
{
    protected $repository;

    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data): Image
    {
        try {
            $image = $this->repository->create($data);

            if (array_key_exists('image', $data)) {
                $image->addMediaFromRequest('image')
                    ->usingFileName(md5((Request::file('image.image')->getClientOriginalName() . Carbon::now()->toTimeString())) . '.' . Request::file('image.image')->getClientOriginalExtension())
                    ->toMediaCollection('image');
            }
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }

        return $image;
    }
}
