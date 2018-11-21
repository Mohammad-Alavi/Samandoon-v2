<?php

namespace App\Containers\Content\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Data\Transporters\CreateArticleTransporter;
use App\Containers\Article\Models\Article;
use App\Containers\Content\Actions\CreateContentAction;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Containers\Content\Tests\TestCase;
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

    public function test_ReturnedContentObjShouldHaveAtLeastArticleAddon()
    {
        // Create a Content
        /** @var Content $content */
        $content = factory(Content::class)->create();

        // Create Article SubAction Mock
        $dataToCreateFakeReturnArticle = [
            'title' => $this->transporterForAction->article->title,
            'text' => $this->transporterForAction->article->text,
            'content_id' => $content->id,
        ];

        $transporterForCreateArticleSubAction = new CreateArticleTransporter($dataToCreateFakeReturnArticle);

        $this->mCreateArticleSubAction->expects($this->once())
            ->method('run')
            ->with($transporterForCreateArticleSubAction)
            ->willReturn(new Article($dataToCreateFakeReturnArticle));

        dump($content);
        $article = $this->mCreateArticleSubAction->run($transporterForCreateArticleSubAction);
        $this->assertEquals($content->id, $article->content_id);
    }

//    public function test_()
//    {
//        $content = $this->createContentAction->run(new DataTransporter([
//            'title' => $this->transporterForAction->article->title,
//            'text' => $this->transporterForAction->article->text,
//        ]));
////        dd($content);
//    }
}
