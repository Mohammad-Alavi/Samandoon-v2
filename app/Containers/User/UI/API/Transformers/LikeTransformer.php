<?php

namespace App\Containers\User\UI\API\Transformers;

class LikeTransformer
{
    /**
     * @param $likePayload
     *
     * @return array
     */
    public function transform($likePayload)
    {
        if ($likePayload['is_liked']) {
            $msg = class_basename($likePayload['user']) . ' (' . $likePayload['user']->getHashedKey() . ') liked ' . class_basename($likePayload['content']) . ' (' . $likePayload['content']->getHashedKey() . ').';
        }
        else {
            $msg = class_basename($likePayload['user']) . ' (' . $likePayload['user']->getHashedKey() . ') unliked ' . class_basename($likePayload['content']) . ' (' . $likePayload['content']->getHashedKey() . ').';
        }
        $response = [
            'msg' => $msg,
            'like_count' => $likePayload['content']->likers()->count(),
            'is_liked' => $likePayload['is_liked'],
        ];
        return $response;
    }
}
