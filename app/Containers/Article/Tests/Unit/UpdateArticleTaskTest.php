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
    /** @var UpdateArticleTask $updateArticleTask */
    private $updateArticleTask;
    /** @var Article $newArticle */
    private $newArticle;
    /** @var array $data */
    private $data;
    /** @var array $dataForUpdate */
    private $dataForUpdate;

    public function setUp()
    {
        parent::setUp();

        $this->data = TestCase::RAW_ARTICLE_DATA;
        $this->newArticle = $this->createNewArticleAndSaveItToDBOrFail($this->data);

        $this->dataForUpdate = [
            'title' => 'This is da new data for update',
            'text' => 'And this is dat new data text and its awesome cus you now it.',
        ];

        $this->updateArticleTask = App::make(UpdateArticleTask::class);
    }

    public function test_UpdateArticleAndReturnAnArticleObject()
    {
        $inputId = $this->newArticle->id;
        $inputData = $this->dataForUpdate;
        $actual = $this->updateArticleTask->run($inputId, $inputData);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of the Article.');
    }

    public function test_ValidateUpdatedArticleData()
    {
        $inputId = $this->newArticle->id;
        $inputData = $this->dataForUpdate;
        $actual = $this->updateArticleTask->run($inputId, $inputData);
        $expected = $this->dataForUpdate;

        $this->assertEquals($expected['title'], $actual->title);
        $this->assertEquals($expected['text'], $actual->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->newArticle);
        unset($this->data);
        unset($this->updateArticleTask);
        unset($this->dataForUpdate);
    }
}
