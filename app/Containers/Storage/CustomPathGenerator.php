<?php

namespace App\Containers\Storage;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPath(Media $media) : string
    {
        return md5($media->id).'/';
    }
    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     * @return string
     */
    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media).'c/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media).'/responsive-images/';
    }

    protected function getBasePath(Media $media): string
    {
        return $media->getKey();
    }
}