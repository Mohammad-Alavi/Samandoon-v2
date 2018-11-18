<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\GetArticleAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\FindArticleByIdTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class FindArticleByIdActionTest.
 *
 * @group article
 * @group unit
 */
class GetArticleActionTest extends TestCase
{
    /** @var FindArticleByIdAction $getArticleByIdAction */
    private $getArticleByIdAction;
    /** @var Article $article */
    private $article;
    /** @var MockObject|FindArticleByIdTask $mFindArticleByIdTask */
    private $mFindArticleByIdTask;
    /** @var DataTransporter $transporterForAction */
    private $transporterForAction;

    public function setUp()
    {
        parent::setUp();

        $this->article = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->mFindArticleByIdTask = $this->getMockBuilder(FindArticleByIdTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->getArticleByIdAction = new GetArticleAction($this->mFindArticleByIdTask);
        $this->transporterForAction = new DataTransporter(['id' => $this->article->id]);
    }

    public function test_FindArticleByIdAndReturnAnArticleObj()
    {
        $this->mFindArticleByIdTask->expects($this->once())
            ->method('run')
            ->with($this->transporterForAction->id)
            ->willReturn($this->article);

        $input = $this->transporterForAction;
        $actual = $this->getArticleByIdAction->run($input);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of the Article.');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->getArticleByIdAction);
        unset($this->article);
        unset($this->transporterForAction);
        unset($this->mFindArticleByIdTask);
    }
}
