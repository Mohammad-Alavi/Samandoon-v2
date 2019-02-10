<?php

namespace App\Containers\Storage\Tasks;

use App\Containers\Storage\Data\Repositories\StorageRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Spatie\MediaLibrary\Models\Media;

class DeleteFileTask extends Task
{
    /**
     * @param Media $media
     */
    public function run(Media $media)
    {
        try {
            $media->delete();
//            return new JsonResponse('Media (' . $request->resource_name . ') deleted.', 200);
        }
        catch (Exception $exception)
        {
            throw new DeleteResourceFailedException('Failed to delete Media.');
        }
    }
}
