<?php

namespace App\Containers\Comment\Tests\Unit;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Comment\Actions\CreateCommentAction;
use App\Containers\Comment\Data\Transporters\CreateCommentTransporter;
use App\Containers\Comment\Models\Comment;
use App\Containers\Comment\Tasks\CreateCommentTask;
use App\Containers\Comment\Tests\TestCase;
use App\Containers\Content\Models\Content;
use App\Containers\User\Models\User;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class CreateCommentActionTest.
 *
 * @group comment
 * @group unit
 */
class CreateCommentActionTest extends TestCase
{
    /** @var CreateCommentAction $createCommentAction */
    private $createCommentAction;
    /** @var MockObject|CreateCommentTask mCreateCommentTask */
    private $mCreateCommentTask;
    /** @var array $dataForCreatingComment */
    private $dataForCreatingComment;
    /** @var Content $content */
    private $content;
    /** @var User $user */
    private $user;
    /** @var DataTransporter */
    private $commentTransporter;
    /** @var GetAuthenticatedUserTask $mGetAuthenticatedUserTask */
    private $mGetAuthenticatedUserTask;
    /**
     * @throws \Throwable
     */
    public function setUp()
    {
        parent::setUp();

        $this->content = $this->createNewContentAndSaveItToDBOrFail();
        $this->user = $this->createNewUserAndSaveItToDBOrFail();
        // this data is for creating the comment
        $this->dataForCreatingComment = [
            'body' => TestCase::RAW_COMMENT_DATA['body'],
            'content_id' => $this->content->id,
            'user_id' => $this->user->id,
            'parent_id' => 631,
        ];
        $this->commentTransporter = new DataTransporter($this->dataForCreatingComment);

        $this->mCreateCommentTask = $this->getMockBuilder(CreateCommentTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->mGetAuthenticatedUserTask = $this->getMockBuilder(GetAuthenticatedUserTask::class)
            ->setMethods(['run'])
            ->getMock();

        $this->createCommentAction = new CreateCommentAction($this->mCreateCommentTask, $this->mGetAuthenticatedUserTask);
    }

    public function test_CreateCommentAndReturnAnCommentObject()
    {
        $this->mCreateCommentTask->expects($this->once())
            ->method('run')
            ->with($this->dataForCreatingComment)
            ->willReturn(new Comment($this->dataForCreatingComment));

        $this->mGetAuthenticatedUserTask->expects($this->once())
            ->method('run')
            ->willReturn($this->user);

        /** @var DataTransporter $input */
        $input = $this->commentTransporter;
        $actual = $this->createCommentAction->run($input);
        $expected = Comment::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of Comment.');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->createCommentAction);
        unset($this->mCreateCommentTask);
        unset($this->dataForCreatingComment);
        unset($this->content);
        unset($this->user);
        unset($this->commentTransporter);
    }
}
