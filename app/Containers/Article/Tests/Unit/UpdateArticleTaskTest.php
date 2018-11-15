<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\UpdateArticleTask;
use App\Containers\Article\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class UpdateArticleTaskTest.
 *
 * @group article
 * @group unit
 */
class UpdateArticleTaskTest extends TestCase
{
    /** @var Article $updatedArticle */
    protected $updatedArticle;
    /** @var CreateArticleTask $task */
    private $task;

    public function setUp()
    {
        parent::setUp();

        $this->article = $this->createNewArticle();
        $this->data = [
            'title' => 'new title',
            'text' => 'new text',
        ];

        $this->task = App::make(UpdateArticleTask::class);
        $this->updatedArticle = $this->task->run($this->article->id, $this->data);
    }

    public function test_UpdateArticleTask()
    {
        $this->assertInstanceOf(Article::class, $this->updatedArticle, 'The returned object is not an instance of the Article.');

        $this->assertEquals($this->article->id, $this->updatedArticle->id);
        $this->assertEquals($this->data['title'], $this->updatedArticle->title);
        $this->assertEquals($this->data['text'], $this->updatedArticle->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->article);
        unset($this->data);
        unset($this->updatedArticle);
        unset($this->task);
    }
}
