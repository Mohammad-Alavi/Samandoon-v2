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
    /**
     * you may want to do something like:
     *
     * 1) create a new Transporter with this data
     * 2) create a specific Action or Task
     * 3) pass the Transporter to the Action / Task
     * 4) assert that everything is correct!
     *
     */

    /** @var Article $article */
    protected $article;
    protected $data;

    public function setUp()
    {
        parent::setUp();

        /** @var CreateArticleTask $task */
        $task = App::make(CreateArticleTask::class);

        // create a data object
        $this->data = [
            'title' => 'این یک نوشته زیبا در مورد یک چیز زیباست',
            'text' => 'این متن قشنگ رو میخوام تقدیم کنم به همه سمن هایی که قدم رنجه فرمودند و در سمندون قدم گذاشتند. به نظر من که کار خیلی خوبی کردند و هرکس دیگری هم که این کار رو بکنه خوب کاری کرده.',
        ];

        $this->article = $task->run($this->data);
    }

    /**
     * @test
     */
    public function test_IsReturningArticleType()
    {
        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of the Article.');
    }

    public function test_IsDataSecCorrectly()
    {
        $this->assertEquals($this->data['title'], $this->article->title);
        $this->assertEquals($this->data['text'], $this->article->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->article);
    }
}
