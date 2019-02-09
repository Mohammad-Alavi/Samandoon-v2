<?php

namespace App\Containers\Image\Tasks;

use App\Containers\Image\Data\Repositories\ImageRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;

class UpdateImageTask extends Task
{

    protected $repository;

    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            $image =  $this->repository->update($data, $id);

            if (array_key_exists('image', $data)) {
                $image->addMediaFromRequest('image')
                    ->usingFileName(md5((Request::file('image.image')->getClientOriginalName() . Carbon::now()->toTimeString())) . '.' . Request::file('image.image')->getClientOriginalExtension())
                    ->toMediaCollection('image');
            }
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }

        return $image;
    }
}
