<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\UpdateArticleAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

/**
 * Class UpdateArticleActionTest.
 *
 * @group article
 * @group unit
 */
class UpdateArticleActionTest extends TestCase
{
    /** @var Article $updatedArticle */
    protected $updatedArticle;
    /** @var CreateArticleTask $action */
    private $action;

    public function setUp()
    {
        parent::setUp();

        $this->article = $this->createNewArticle();

        $this->data = [
            'id' => $this->article->id,
            'title' => 'new title',
            'text' => 'new text',
        ];

        $this->action = App::make(UpdateArticleAction::class);
        $this->transporter = new DataTransporter($this->data);
        $this->updatedArticle = $this->action->run($this->transporter);
    }

    public function test_UpdateArticleTask()
    {
        $this->assertInstanceOf(Article::class, $this->updatedArticle, 'The returned object is not an instance of the Article.');

        $this->assertEquals($this->article->id, $this->updatedArticle->id);
        $this->assertEquals($this->data['title'], $this->updatedArticle->title);
        $this->assertEquals($this->data['text'], $this->updatedArticle->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->article);
        unset($this->data);
        unset($this->transporter);
        unset($this->updatedArticle);
        unset($this->action);
    }
}
