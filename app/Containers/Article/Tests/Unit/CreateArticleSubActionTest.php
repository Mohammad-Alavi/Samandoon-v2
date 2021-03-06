<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Containers\Article\Tests\TestCase;
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
    /** @var array $dataForCreatingArticle */
    private $dataForCreatingArticle;

    public function setUp()
    {
        parent::setUp();

        // this data is for creating the article
        $this->dataForCreatingArticle = [
            'title' => TestCase::RAW_ARTICLE_DATA['title'],
            'text' => TestCase::RAW_ARTICLE_DATA['text'],
            'content_id' => 1,
        ];

        $this->mCreateArticleTask = $this->getMockBuilder(CreateArticleTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->createArticleSubAction = new CreateArticleSubAction($this->mCreateArticleTask);
    }

    public function test_CreateArticleAndReturnAnArticleObject()
    {
        $this->mCreateArticleTask->expects($this->once())
            ->method('run')
            ->with($this->dataForCreatingArticle)
            ->willReturn(new Article($this->dataForCreatingArticle));

        $input = $this->dataForCreatingArticle;
        $actual = $this->createArticleSubAction->run($input, $input['content_id']);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of Article.');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->createArticleSubAction);
        unset($this->dataForCreatingArticle);
        unset($this->mCreateArticleTask);
    }
}
