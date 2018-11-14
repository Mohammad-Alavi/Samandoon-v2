<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\FindArticleByIdTask;
use App\Containers\Article\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class FindArticleByIdTaskTest.
 *
 * @group article
 * @group unit
 */
class FindArticleByIdTaskTest extends TestCase
{
    /** @var FindArticleByIdTask $task */
    private $task;
    /** @var Article $foundArticle */
    private $foundArticle;

    public function setUp()
    {
        parent::setUp();
        $this->article = $this->createNewArticle(1);
        $this->task = App::make(FindArticleByIdTask::class);
        $this->foundArticle = $this->task->run($this->article->id);
    }

    public function test_FindArticleByIdTask()
    {
        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of the Article.');

        $this->assertEquals($this->article->id, $this->foundArticle->id);
        $this->assertEquals($this->article->title, $this->foundArticle->title);
        $this->assertEquals($this->article->text, $this->foundArticle->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->task);
        unset($this->article);
        unset($this->foundArticle);
    }
}