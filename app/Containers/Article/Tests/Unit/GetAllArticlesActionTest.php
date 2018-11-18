<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\GetAllArticlesAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\GetAllArticlesTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class GetAllArticlesActionTest.
 *
 * @group article
 * @group unit
 */
class GetAllArticlesActionTest extends TestCase
{
    /** @var GetAllArticlesAction $getAllArticlesAction */
    private $getAllArticlesAction;
    /** @var MockObject|GetAllArticlesTask $mGetAllArticlesTask */
    private $mGetAllArticlesTask;
    /** @var LengthAwarePaginator $foundArticles */
    private $foundArticles;
    /** @var Article $article */
    private $article;
    /** @var DataTransporter $transporterForAction */
    private $transporterForAction;
    /** @var array $articleArray */
    private $articleArray;
    /** @var array $dataToCreateNewArticle */
    private $dataToCreateNewArticle;

    public function setUp()
    {
        parent::setUp();

        // Create 5 Article for testing purpose
        $this->articleArray[0] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->articleArray[1] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->articleArray[2] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->articleArray[3] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->articleArray[4] = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);

        $this->mGetAllArticlesTask = $this->getMockBuilder(GetAllArticlesTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->getAllArticlesAction = new GetAllArticlesAction($this->mGetAllArticlesTask);
        $this->transporterForAction = new DataTransporter([]);
    }

    public function test_GetAllArticlesAndReturnALengthAwarePaginator()
    {
        $mGetAllArticlesRunReturnData = new LengthAwarePaginator($this->articleArray, count($this->articleArray), env('PAGINATION_LIMIT_DEFAULT', 10), 1);
        $this->mGetAllArticlesTask->expects($this->once())
            ->method('run')
            ->willReturn($mGetAllArticlesRunReturnData);

        $input = $this->transporterForAction;
        $actual = $this->getAllArticlesAction->run($input);
        $expected = LengthAwarePaginator::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not a LengthAwarePaginator');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->getAllArticlesAction);
        unset($this->mGetAllArticlesTask);
        unset($this->foundArticles);
        unset($this->article);
        unset($this->articleArray);
        unset($this->transporterForAction);
        unset($this->dataToCreateNewArticle);
    }
}
