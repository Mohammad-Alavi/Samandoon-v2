<?php

namespace App\Containers\Comment\Tests;

use App\Containers\Comment\Models\Comment;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;

/**
 * Class TestCase.
 *
 * This is the container Main TestCase class. Use this class to add your container specific helper functions.
 */
class TestCase extends ShipTestCase
{
    protected const RAW_COMMENT_DATA = [
        'body' => 'کامنتی زیبا برای اپی زیبا',
    ];

    /**
     * @param array $data
     *
     * @return Comment
     * @throws \Throwable
     */
    protected function createNewCommentAndSaveItToDBOrFail()
    {
        $comment = new Comment();
        $comment->saveOrFail();
        return $comment;
    }
}
