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
    /** @var Article $article */
    private $article;
    /** @var array $data */
    private $data;
    /** @var FindArticleByIdTask $task */
    private $task;
    /** @var Article $foundArticle */
    private $foundArticle;

    public function setUp()
    {
        parent::setUp();

        $this->data = [
            'title' => 'این یک تایتل زیبا در مورد یک نوشته زیباست',
            'text' => 'این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست',
        ];

        // Create a new article with the provided data and save it into the database
        $this->article = new Article($this->data);
        $this->article->save();

        $this->task = App::make(FindArticleByIdTask::class);
    }

    public function test_FindArticleByIdTask()
    {
        $this->foundArticle = $this->task->run($this->article->id);
        // Unset wasRecentlyCreated property on both object to prevent error when asserting for equality of objects
        unset($this->article->wasRecentlyCreated);
        unset($this->foundArticle->wasRecentlyCreated);

        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of the Article.');
        $this->assertEquals($this->article, $this->foundArticle);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->task);
        unset($this->data);
        unset($this->article);
        unset($this->foundArticle);
    }
}