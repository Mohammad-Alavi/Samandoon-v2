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
    /** @var LengthAwarePaginator $articles */
    private $articles;
    /** @var Article $article */
    private $article;
    /** @var DataTransporter $transporter */
    private $transporter;
    /** @var array $articleArray */
    private $articleArray;
    /** @var array $dataToCreateNewArticle */
    private $dataToCreateNewArticle;
    /** @var LengthAwarePaginator $mGetAllArticlesRunReturnData */
    private $mGetAllArticlesRunReturnData;

    public function setUp()
    {
        parent::setUp();

        // Create 5 Article for testing purpose
        $this->articleArray[0] = $this->createNewArticle();
        $this->articleArray[1] = $this->createNewArticle();
        $this->articleArray[2] = $this->createNewArticle();
        $this->articleArray[3] = $this->createNewArticle();
        $this->articleArray[4] = $this->createNewArticle();

        $this->mGetAllArticlesTask = $this->getMockBuilder(GetAllArticlesTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->getAllArticlesAction = new GetAllArticlesAction($this->mGetAllArticlesTask);
        $this->transporter = new DataTransporter([]);
        $this->mGetAllArticlesRunReturnData = new LengthAwarePaginator($this->articleArray, count($this->articleArray), 15, 1);
    }

    public function test_GetAllArticlesTask()
    {
        $this->mGetAllArticlesTask->expects($this->once())
            ->method('run')
            ->willReturn($this->mGetAllArticlesRunReturnData);

        $this->articles = $this->getAllArticlesAction->run($this->transporter);

        $this->assertInstanceOf(LengthAwarePaginator::class, $this->articles, 'The returned object is not a Collection');

        $this->assertEquals(5, count($this->articles->items()));
        $this->assertEquals($this->mGetAllArticlesRunReturnData, $this->articles);
    }

    private function createNewArticle()
    {
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
        unset($this->getAllArticlesAction);
        unset($this->mGetAllArticlesTask);
        unset($this->articles);
        unset($this->article);
        unset($this->articleArray);
        unset($this->transporter);
        unset($this->mGetAllArticlesRunReturnData);
        unset($this->dataToCreateNewArticle);
    }
}
