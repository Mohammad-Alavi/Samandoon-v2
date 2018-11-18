<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleAction;
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
class CreateArticleActionTest extends TestCase
{
    /** @var CreateArticleAction $createArticleAction */
    private $createArticleAction;
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

        $this->createArticleAction = new CreateArticleAction($this->mCreateArticleTask);
        $this->transporterForAction = new DataTransporter($this->data);
    }

    public function test_CreateArticleAndReturnAnArticleObject()
    {
        $this->mCreateArticleTask->expects($this->once())
            ->method('run')
            ->with($this->data)
            ->willReturn(new Article($this->data));

        $input = $this->transporterForAction;
        $actual = $this->createArticleAction->run($input);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of Article.');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->createArticleAction);
        unset($this->data);
        unset($this->transporterForAction);
        unset($this->mCreateArticleTask);
    }
}
