<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Faker\Generator;
use Illuminate\Support\Facades\App;

/**
 * Class CreateArticleActionTest.
 *
 * @group article
 * @group unit
 */
class CreateArticleActionTest extends TestCase
{
    /**@var  array $data */
    protected $data;
    /**@var DataTransporter $transporter */
    protected $transporter;
    /**@var Article $article */
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
        /** @var CreateArticleAction $action */
        $action = App::make(CreateArticleAction::class);
        $this->article = $action->run($this->transporter);
    }

    public function test_CreateUserAction()
    {
        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of Article.');

        $this->assertEquals($this->data['title'], $this->article->title);
        $this->assertEquals($this->data['text'], $this->article->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->data);
        unset($this->transporter);
    }
}
