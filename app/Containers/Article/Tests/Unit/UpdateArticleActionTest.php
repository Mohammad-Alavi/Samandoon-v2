<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleAction;
use App\Containers\Article\Actions\UpdateArticleAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\UpdateArticleTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class UpdateArticleActionTest.
 *
 * @group article
 * @group unit
 */
class UpdateArticleActionTest extends TestCase
{
    /** @var Article $updatedArticle */
    private $updatedArticle;
    /** @var UpdateArticleAction $updateArticleAction */
    private $updateArticleAction;
    /** @var array $dataToCreateTempArticle */
    private $dataToCreateTempArticle;
    /** @var array $dataForUpdatingArticle */
    private $dataForUpdatingArticle;
    /** @var DataTransporter $transporterPassedToAction */
    private $transporterPassedToAction;
    /** @var Article $articleCreatedForTest */
    private $articleCreatedForTest;
    /** @var MockObject|UpdateArticleTask $mUpdateArticleTask */
    private $mUpdateArticleTask;
    /** @var array $dataForMockUpdateArticleTask */
    private $dataForMockUpdateArticleTask;
    /** @var Article $mArticleToReturnFromMockUpdateTask */
    private $mArticleToReturnFromMockUpdateTask;

    public function setUp()
    {
        parent::setUp();

        $this->dataToCreateTempArticle = [
            'title' => 'این یک تایتل زیبا در مورد یک نوشته زیباست',
            'text' => 'این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست',
        ];

        // Create a new article with the provided data and save it into the database
        $this->articleCreatedForTest = new Article($this->dataToCreateTempArticle);
        $this->articleCreatedForTest->save();

        $this->dataForUpdatingArticle = [
            'id' => $this->articleCreatedForTest->id,
            'title' => 'This is da new data for update',
            'text' => 'And this is dat new data text and its awesome cus you now it.',
        ];

        $this->mUpdateArticleTask = $this->getMockBuilder(UpdateArticleTask::class)
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->updateArticleAction = new UpdateArticleAction($this->mUpdateArticleTask);
        $this->transporterPassedToAction = new DataTransporter($this->dataForUpdatingArticle);

        // Array for mockObject
        $this->dataForMockUpdateArticleTask = [
            'title' => $this->dataForUpdatingArticle['title'],
            'text' => $this->dataForUpdatingArticle['text'],
        ];
        // Article for mocked method of updateArticleTask
        $this->mArticleToReturnFromMockUpdateTask = Article::make($this->dataForMockUpdateArticleTask);
        $this->mArticleToReturnFromMockUpdateTask->id = $this->articleCreatedForTest->id;
    }

    public function test_UpdateArticleTask()
    {
        $this->mUpdateArticleTask->expects($this->once())
            ->method('run')
            ->with($this->articleCreatedForTest->id, $this->dataForMockUpdateArticleTask)
            ->willReturn(dump($this->mArticleToReturnFromMockUpdateTask));

        $this->updatedArticle = $this->updateArticleAction->run($this->transporterPassedToAction);

        $this->assertInstanceOf(Article::class, $this->updatedArticle, 'The returned object is not an instance of the Article.');

        $this->assertEquals($this->articleCreatedForTest->id, $this->updatedArticle->id);
        $this->assertEquals($this->dataForUpdatingArticle['title'], $this->updatedArticle->title);
        $this->assertEquals($this->dataForUpdatingArticle['text'], $this->updatedArticle->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->updatedArticle);
        unset($this->updateArticleAction);
        unset($this->dataToCreateTempArticle);
        unset($this->dataForUpdatingArticle);
        unset($this->transporterPassedToAction);
        unset($this->articleCreatedForTest);
        unset($this->mUpdateArticleTask);
        unset($this->dataForMockUpdateArticleTask);
        unset($this->mArticleToReturnFromMockUpdateTask);
    }
}
