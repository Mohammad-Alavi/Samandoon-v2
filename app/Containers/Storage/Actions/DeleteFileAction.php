<?php

namespace App\Containers\Storage\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class DeleteFileAction extends Action
{
    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     * @throws \Dto\Exceptions\UnstorableValueException
     * @throws \Throwable
     */
    public function run(DataTransporter $transporter)
    {
        /** @var Media $media */
        $media = Media::find($transporter->id);
        throw_unless($media, new NotFoundException('Media not found'));
        /** @var User $authenticatedUser */
        $authenticatedUser = Apiato::call('Authentication@GetAuthenticatedUserTask');
        throw_if($authenticatedUser->id != $media->model_id, new AccessDeniedException('You are not the owner of this file'));
        return $this->call('Storage@DeleteFileTask', [$media]);
    }
}
