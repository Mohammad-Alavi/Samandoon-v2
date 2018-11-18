<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\DeleteArticleAction;
use App\Containers\Article\Data\Transporters\DeleteArticleTransporter;
use App\Containers\Article\Tasks\DeleteArticleTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class DeleteArticleActionTest.
 *
 * @group article
 * @group unit
 */
class DeleteArticleActionTest extends TestCase
{
    /** @var DeleteArticleAction $deleteArticleAction */
    private $deleteArticleAction;
    /** @var DeleteArticleTask|MockObject $mDeleteArticleTask */
    private $mDeleteArticleTask;
    /** @var DeleteArticleTransporter $deleteArticleTransporter */
    private $deleteArticleTransporter;
    public function setUp()
    {
        parent::setUp();
        $this->mDeleteArticleTask = $this->getMockBuilder(DeleteArticleTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleteArticleAction = new DeleteArticleAction($this->mDeleteArticleTask);
        $this->deleteArticleTransporter = new DataTransporter(['id' => 1]);
    }

    public function test_DeleteArticleAndReturnTrue()
    {
        $this->mDeleteArticleTask->expects($this->once())
            ->method('run')
            ->with($this->deleteArticleTransporter->id)
            ->willReturn(true);

        $input = $this->deleteArticleTransporter;
        $actual = $this->deleteArticleAction->run($input);
        $expected = true;

        $this->assertEquals($expected, $actual);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->deleteArticleAction);
        unset($this->mDeleteArticleTask);
        unset($this->deleteArticleTransporter);
    }
}
