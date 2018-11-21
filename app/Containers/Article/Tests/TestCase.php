<?php

namespace App\Containers\Article\Tests;

use App\Containers\Article\Models\Article;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;

/**
 * Class TestCase.
 *
 * This is the container Main TestCase class. Use this class to add your container specific helper functions.
 */
class TestCase extends ShipTestCase
{
    // Replace ShipTestCase Constant and new 'content_id' to it
    protected const RAW_ARTICLE_DATA = [
        'title' => ShipTestCase::RAW_ARTICLE_DATA['title'],
        'text' => ShipTestCase::RAW_ARTICLE_DATA['text'],
        'content_id' => 1,
    ];

    /**
     * @param array $data
     * @return Article
     * @throws \Throwable
     */
    protected function createNewArticleAndSaveItToDBOrFail(array $data)
    {
        $article = new Article($data);
        $article->saveOrFail();
        return $article;
    }
}