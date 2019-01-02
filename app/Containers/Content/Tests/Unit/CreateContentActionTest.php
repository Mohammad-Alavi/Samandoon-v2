<?php

namespace App\Containers\Content\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Models\Article;
use App\Containers\Content\Actions\CreateContentAction;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Containers\Content\Tests\TestCase;
use App\Containers\User\Models\User;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class CreateContentActionTest.
 *
 * @group content
 * @group unit
 */
class CreateContentActionTest extends TestCase
{
    /** @var CreateContentAction $createContentAction */
    private $createContentAction;
    /** @var CreateContentTask|MockObject $mCreateContentTask */
    private $mCreateContentTask;
    /** @var CreateArticleSubAction|MockObject $mCreateArticleSubAction */
    private $mCreateArticleSubAction;
    /** @var DataTransporter $transporterForAction */
    private $transporterForAction;
    /** @var array $data */
    private $data;
// TODO Implement Create Content Action Test
    public function setUp()
    {
        parent::setUp();

        // Create Article SubAction Bock
        $this->mCreateArticleSubAction = $this->getMockBuilder(CreateArticleSubAction::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        // Create Content Block
        $this->mCreateContentTask = $this->getMockBuilder(CreateContentTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->createContentAction = new CreateContentAction($this->mCreateContentTask, $this->mCreateArticleSubAction);


        $this->transporterForAction = new DataTransporter([
            'article' => [
                'title' => TestCase::RAW_ARTICLE_DATA['title'],
                'text' => TestCase::RAW_ARTICLE_DATA['text'],
            ]
        ]);
    }

    public function test_ShouldCreateContentAndReturnAContentObject()
    {
        // Create Content Task Mock
        $createContentTaskInput = [];
        $this->mCreateContentTask->expects($this->once())
            ->method('run')
            ->with($createContentTaskInput)
            ->willReturn(new Content($createContentTaskInput));

        $input = $this->transporterForAction;
        $actual = $this->createContentAction->run($input);
        $expected = Content::class;

        $this->assertInstanceOf($expected, $actual);
    }
}
