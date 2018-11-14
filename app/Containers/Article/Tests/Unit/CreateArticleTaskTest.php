<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Containers\Article\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class CreateArticleTaskTest.
 *
 * @group article
 * @group unit
 */
class CreateArticleTaskTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        /** @var CreateArticleTask $task */
        $task = App::make(CreateArticleTask::class);
        $this->article = $task->run($this->data);
    }

    public function test_CreateArticleAction()
    {
        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of the Article.');

        $this->assertEquals($this->data['title'], $this->article->title);
        $this->assertEquals($this->data['text'], $this->article->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->article);
    }
}
