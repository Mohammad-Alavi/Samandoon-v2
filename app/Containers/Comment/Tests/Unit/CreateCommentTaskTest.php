<?php

namespace App\Containers\Comment\Tests\Unit;

use App\Containers\Comment\Models\Comment;
use App\Containers\Comment\Tasks\CreateCommentTask;
use App\Containers\Comment\Tests\TestCase;
use App\Containers\Content\Models\Content;
use App\Containers\User\Models\User;
use Illuminate\Support\Facades\App;

/**
 * Class CreateCommentTaskTest.
 *
 * @group comment
 * @group unit
 */
class CreateCommentTaskTest extends TestCase
{
    /** @var CreateCommentTask $createCommentTask */
    private $createCommentTask;
    /** @var Content $content */
    private $content;
    /** @var User $user */
    private $user;
    /** @var array $data */
    private $data;

    public function setUp()
    {
        parent::setUp();

        $this->content = $this->createNewContentAndSaveItToDBOrFail();
        $this->user = $this->createNewUserAndSaveItToDBOrFail();
        $this->createCommentTask = App::make(CreateCommentTask::class);
        $this->data = [
            'body' => TestCase::RAW_COMMENT_DATA['body'],
            'content_id' => $this->content->id,
            'user_id' => $this->user->id,
            'parent_id' => 631,
        ];
    }

    public function test_CreateCommentAndReturnAnCommentObject()
    {
        $input = $this->data;
        $actual = $this->createCommentTask->run($input);
        $expected = Comment::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of the Comment Class.');
    }

    public function test_ValidateCreatedCommentData()
    {
        $input = $this->data;
        $actual = $this->createCommentTask->run($input);
        $expected = $input;

        $this->assertEquals($expected['body'], $actual->body);
        $this->assertEquals($expected['content_id'], $actual->content_id);
        $this->assertEquals($expected['user_id'], $actual->user_id);
        $this->assertEquals($expected['parent_id'], $actual->parent_id);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->createCommentTask);
        unset($this->content);
        unset($this->user);
        unset($this->data);
    }
}
