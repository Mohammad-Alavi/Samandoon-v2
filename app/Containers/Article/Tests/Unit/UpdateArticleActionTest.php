<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\UpdateArticleSubAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\UpdateArticleTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class UpdateArticleActionTest.
 *
 * @group article
 * @group unit
 */
class UpdateArticleActionTest extends TestCase
{
    /** @var UpdateArticleSubAction $updateArticleAction */
    private $updateArticleAction;
    /** @var array $dataForUpdate */
    private $dataForUpdate;
    /** @var Article $newArticle */
    private $newArticle;
    /** @var MockObject|UpdateArticleTask $mUpdateArticleTask */
    private $mUpdateArticleTask;

    /**
     * @throws \Throwable
     */
    public function setUp()
    {
        parent::setUp();

        $this->dataForUpdate = [
            'title' => 'This is da new data for update',
            'text' => 'And this is dat new data text and its awesome cus you now it.',
        ];

        $this->mUpdateArticleTask = $this->getMockBuilder(UpdateArticleTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->updateArticleAction = new UpdateArticleSubAction($this->mUpdateArticleTask);
        $this->transporterForAction = new DataTransporter($this->dataForUpdate);
    }

    public function test_UpdateArticleAndReturnAnArticleObj()
    {
        $mockedMethodInputData = [
            'title' => $this->transporterForAction->title,
            'text' => $this->transporterForAction->text,
        ];
        $this->mUpdateArticleTask->expects($this->once())
            ->method('run')
            ->with($mockedMethodInputId, $mockedMethodInputData)
            ->willReturn(new Article($this->dataForUpdate));
        
        $actual = $this->updateArticleAction->run($mockedMethodInputData, $mockedMethodInputId);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of the Article.');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->updateArticleAction);
        unset($this->dataForUpdate);
        unset($this->transporterForAction);
        unset($this->newArticle);
        unset($this->mUpdateArticleTask);
    }
}
