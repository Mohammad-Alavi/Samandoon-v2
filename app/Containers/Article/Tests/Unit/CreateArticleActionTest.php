<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleAction;
use App\Containers\Article\Data\Repositories\ArticleRepository;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class CreateArticleActionTest.
 *
 * @group article
 * @group unit
 */
class CreateArticleActionTest extends TestCase
{
    /** @var CreateArticleTask $action */
    private $action;
    /** @var MockObject|CreateArticleTask createArticleTask */
    private $createArticleTask;
    /** @var Article $article */
    private $article;
    /** @var array $data */
    private $data;
    /** @var DataTransporter $transporter */
    private $transporter;

    public function setUp()
    {
        parent::setUp();
        $this->createArticleTask = $this->getMockBuilder(CreateArticleTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->action = new CreateArticleAction($this->createArticleTask);

        $this->data = [
            'title' => 'این یک تایتل زیبا در مورد یک نوشته زیباست',
            'text' => 'این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست',
        ];
        $this->transporter = new DataTransporter($this->data);
    }

    public function test_CreateUserAction()
    {
        $this->createArticleTask->expects($this->once())
            ->method('run')
            ->with($this->data)
            ->willReturn(new Article($this->data));
        $this->article = $this->action->run($this->transporter);

        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of Article.');

        $this->assertEquals($this->data['title'], $this->article->title);
        $this->assertEquals($this->data['text'], $this->article->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->action);
        unset($this->article);
        unset($this->data);
        unset($this->transporter);
        unset($this->createArticleTask);
    }
}
