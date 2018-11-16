<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\GetArticleAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\FindArticleByIdTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class FindArticleByIdActionTest.
 *
 * @group article
 * @group unit
 */
class GetArticleActionTest extends TestCase
{
    /** @var FindArticleByIdAction $action */
    private $action;
    /** @var Article $foundArticle */
    private $foundArticle;
    /** @var Article $article */
    private $article;
    /** @var array $data */
    private $data;
    /** @var MockObject|FindArticleByIdTask $findArticleByIdTask */
    private $findArticleByIdTask;
    /** @var DataTransporter $transporter */
    private $transporter;

    public function setUp()
    {
        parent::setUp();

        $this->data = [
            'title' => 'این یک تایتل زیبا در مورد یک نوشته زیباست',
            'text' => 'این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست',
        ];
        // Create a new article with the provided data and save it into the database
        $this->article = new Article($this->data);
        $this->article->save();

        $this->findArticleByIdTask = $this->getMockBuilder(FindArticleByIdTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->action = new GetArticleAction($this->findArticleByIdTask);
        $this->transporter = new DataTransporter(['id' => $this->article->id]);
    }

    public function test_FindArticleByIdAction()
    {
        $this->findArticleByIdTask->expects($this->once())
            ->method('run')
            ->with($this->article->id)
            ->willReturn($this->article);
        $this->foundArticle = $this->action->run($this->transporter);

        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of the Article.');

        $this->assertEquals($this->article, $this->foundArticle);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->action);
        unset($this->article);
        unset($this->data);
        unset($this->transporter);
        unset($this->foundArticle);
        unset($this->findArticleByIdTask);
    }
}
