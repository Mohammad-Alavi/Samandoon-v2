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
    /** @var GetAllArticlesTask $getAllArticlesTask */
    private $getAllArticlesTask;
    /** @var array $articleArray */
    private $articleArray;

    public function setUp()
    {
        parent::setUp();

        // Create 5 Article for testing purpose
        $this->articleArray[0] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->articleArray[1] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->articleArray[2] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->articleArray[3] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->articleArray[4] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);

        $this->getAllArticlesTask = App::make(GetAllArticlesTask::class);
    }

    public function test_GetAllArticlesShouldReturnAnLengthAwarePaginator()
    {
        // we don't have an input
        $input = '';
        $actual = $this->getAllArticlesTask->run();
        $expected = LengthAwarePaginator::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not a LengthAwarePaginator');
    }

    public function test_validateFoundArticlesData()
    {
        // we don't have an input
        $input = '';
        $actual = $this->getAllArticlesTask->run();
        // wut ;o
        $expected = '';

        $this->assertEquals(count($this->articleArray), $actual->getCollection()->count());
        $this->assertTrue($actual->contains('title', TestCase::RAW_ARTICLE_DATA['title']));
        $this->assertTrue($actual->contains('text', TestCase::RAW_ARTICLE_DATA['text']));
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->getAllArticlesTask);
        unset($this->article);
    }
}
