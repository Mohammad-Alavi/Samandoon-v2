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
    /** @var Article $createdArticle */
    private $createdArticle;
    /** @var FindArticleByIdTask $findArticleByIdTask */
    private $findArticleByIdTask;
    /** @var Article $foundArticle */
    private $foundArticle;

    public function setUp()
    {
        parent::setUp();

        $this->createdArticle = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->findArticleByIdTask = App::make(FindArticleByIdTask::class);
    }

    public function test_FindArticleByIdAndReturnAnArticleObj()
    {
        $input = $this->createdArticle->id;
        $actual = $this->findArticleByIdTask->run($input);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of the Article.');
    }

    public function test_ValidateFoundArticleData()
    {
        $input = $this->createdArticle->id;
        /** @var Article $actual */
        $actual = $this->findArticleByIdTask->run($input);
        /** @var Article $expected */
        $expected = $this->createdArticle;

        // Cast both to array for easier comparison
        $actual = $actual->toArray();
        $expected = $expected->toArray();
        // Unset deleted_at to prevent error when asserting for equality of objects
        unset($actual['deleted_at']);

        $this->assertEquals($expected, $actual);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->findArticleByIdTask);
        unset($this->createdArticle);
        unset($this->foundArticle);
    }
}