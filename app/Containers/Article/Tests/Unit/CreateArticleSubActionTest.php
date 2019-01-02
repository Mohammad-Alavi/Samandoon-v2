<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Data\Transporters\CreateArticleTransporter;
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
    /** @var DataTransporter $transporterForSubAction */
    private $transporterForSubAction;

    public function setUp()
    {
        parent::setUp();
        $this->data = [
            'article' => [
                'title' => TestCase::RAW_ARTICLE_DATA['title'],
                'text' => TestCase::RAW_ARTICLE_DATA['text']
            ]
        ];

        $this->mCreateArticleTask = $this->getMockBuilder(CreateArticleTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->createArticleSubAction = new CreateArticleSubAction($this->mCreateArticleTask);
        $this->transporterForSubAction = new CreateArticleTransporter($this->data);
    }

    public function test_CreateArticleAndReturnAnArticleObject()
    {
        $this->mCreateArticleTask->expects($this->once())
            ->method('run')
            ->with($this->data)
            ->willReturn(new Article($this->data));

        $input = $this->transporterForSubAction;
        $actual = $this->createArticleSubAction->run($input);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of Article.');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->createArticleSubAction);
        unset($this->data);
        unset($this->transporterForSubAction);
        unset($this->mCreateArticleTask);
    }
}
