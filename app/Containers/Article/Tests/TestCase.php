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
    protected const RAW_ARTICLE_DATA = [
        'title' => 'این یک تایتل زیبا در مورد یک نوشته زیباست',
        'text' => 'این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست',

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