<?php

namespace App\Containers\Article\Tests;

use App\Containers\Article\Models\Article;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;
use App\Ship\Transporters\DataTransporter;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class TestCase.
 *
 * This is the container Main TestCase class. Use this class to add your container specific helper functions.
 */
class TestCase extends ShipTestCase
{
    /**@var  array $data */
    protected $data;
    /**@var DataTransporter $transporter */
    protected $transporter;
    /** @var Article $article */
    protected $article;

    public function setUp()
    {
        parent::setUp();
        // create a data object
        $this->data = [
            'title' => $this->faker->realText(80),
            'text' => $this->faker->realText(200),
        ];

        $this->transporter = new DataTransporter($this->data);
    }

    /**
     * @return Article
     */
    public function createNewArticle($id)
    {
        array_add($this->data, 'id', $id);
        $article = new Article($this->data);
        $article->save();
        return $article;
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->data);
        unset($this->transporter);
        unset($this->article);
        unset($this->articleId);
    }
}
