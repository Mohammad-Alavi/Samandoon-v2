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
    private $updatedArticle;
    /** @var UpdateArticleTask $updateArticleTask */
    private $updateArticleTask;
    /** @var Article $article */
    private $article;
    /** @var array $data */
    private $data;
    /** @var array $dataForUpdate */
    private $dataForUpdate;

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

        $this->dataForUpdate = [
            'title' => 'This is da new data for update',
            'text' => 'And this is dat new data text and its awesome cus you now it.',
        ];

        $this->updateArticleTask = App::make(UpdateArticleTask::class);
        $this->updatedArticle = $this->updateArticleTask->run($this->article->id, $this->dataForUpdate);
    }

    public function test_UpdateArticleTask()
    {
        $this->assertInstanceOf(Article::class, $this->updatedArticle, 'The returned object is not an instance of the Article.');

        $this->assertEquals($this->article->id, $this->updatedArticle->id);
        $this->assertEquals($this->dataForUpdate['title'], $this->updatedArticle->title);
        $this->assertEquals($this->dataForUpdate['text'], $this->updatedArticle->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->article);
        unset($this->data);
        unset($this->updatedArticle);
        unset($this->updateArticleTask);
        unset($this->dataForUpdate);
    }
}
