<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\GetAllArticlesTask;
use App\Containers\Article\Tests\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;

/**
 * Class GetAllArticlesTaskTest.
 *
 * @group article
 * @group unit
 */
class GetAllArticlesTaskTest extends TestCase
{
    /** @var GetAllArticlesTask $task */
    private $task;
    /** @var LengthAwarePaginator $articles */
    private $articles;
    /** @var array $dataToCreateNewArticle */
    private $dataToCreateNewArticle;

    private $article;

    public function setUp()
    {
        parent::setUp();

        // Create 5 Article for testing purpose
        $this->createNewArticle();
        $this->createNewArticle();
        $this->createNewArticle();
        $this->createNewArticle();
        $this->createNewArticle();

        $this->task = App::make(GetAllArticlesTask::class);
        $this->articles = $this->task->run();
    }

    public function test_GetAllArticlesTask()
    {
        $this->assertInstanceOf(LengthAwarePaginator::class, $this->articles, 'The returned object is not a LengthAwarePaginator');
        $this->assertEquals(5, $this->articles->getCollection()->count());
        $this->assertTrue($this->articles->contains('title', $this->dataToCreateNewArticle['title']));
        $this->assertTrue($this->articles->contains('text', $this->dataToCreateNewArticle['text']));
    }

    private function createNewArticle() {
        $this->dataToCreateNewArticle = [
            'title' => 'این یک تایتل زیبا در مورد یک نوشته زیباست',
            'text' => 'این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست',
        ];

        // Create a new article with the provided data and save it into the database
        $this->article = new Article($this->dataToCreateNewArticle);
        $this->article->save();

        return $this->article;
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->task);
        unset($this->articles);
        unset($this->article);
    }
}
