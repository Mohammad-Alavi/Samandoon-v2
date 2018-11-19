<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class CreateArticleActionTest.
 *
 * @group article
 * @group unit
 */
class CreateArticleSubActionTest extends TestCase
{
    /** @var CreateArticleSubAction $createArticleSubAction */
    private $createArticleSubAction;
    /** @var MockObject|CreateArticleTask createArticleTask */
    private $mCreateArticleTask;
    /** @var array $data */
    private $data;
    /** @var DataTransporter $transporterForAction */
    private $transporterForAction;

    public function setUp()
    {
        parent::setUp();

        $this->data = TestCase::RAW_ARTICLE_DATA;

        $this->mCreateArticleTask = $this->getMockBuilder(CreateArticleTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->createArticleSubAction = new CreateArticleSubAction($this->mCreateArticleTask);
        $this->transporterForAction = new DataTransporter($this->data);
    }

    public function test_CreateArticleAndReturnAnArticleObject()
    {
        $this->mCreateArticleTask->expects($this->once())
            ->method('run')
            ->with($this->data)
            ->willReturn(new Article($this->data));

        $input = $this->transporterForAction;
        $actual = $this->createArticleSubAction->run($input);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of Article.');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->createArticleSubAction);
        unset($this->data);
        unset($this->transporterForAction);
        unset($this->mCreateArticleTask);
    }
}
