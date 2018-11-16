<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Exceptions\CreateResourceFailedException;
use Illuminate\Support\Facades\App;

/**
 * Class CreateArticleTaskTest.
 *
 * @group article
 * @group unit
 */
class CreateArticleTaskTest extends TestCase
{
    /** @var CreateArticleTask $task */
    private $task;
    /** @var Article $article */
    private $article;
    /** @var array $data */
    private $data;

    public function setUp()
    {
        parent::setUp();

        $this->task = App::make(CreateArticleTask::class);

        $this->data = [
            'title' => 'این یک تایتل زیبا در مورد یک نوشته زیباست',
            'text' => 'این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست',
        ];
    }

    public function test_CreateArticleTask_ReturnArticle()
    {
        $this->article = $this->task->run($this->data);

        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of the Article.');
        $this->assertNotEmpty($this->article->id);
        $this->assertEquals($this->data['title'], $this->article->title);
        $this->assertEquals($this->data['text'], $this->article->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->task);
        unset($this->article);
        unset($this->data);
    }
}
