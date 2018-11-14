<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\FindArticleByIdAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

/**
 * Class FindArticleByIdActionTest.
 *
 * @group article
 * @group unit
 */
class FindArticleByIdActionTest extends TestCase
{
    /** @var FindArticleByIdAction $action */
    private $action;
    /** @var Article $foundArticle */
    private $foundArticle;

    public function setUp()
    {
        parent::setUp();
        $this->article = $this->createNewArticle(1);

        $this->data = [
            'id' => $this->article->id,
        ];

        $this->action = App::make(FindArticleByIdAction::class);
        $this->transporter = new DataTransporter($this->data);
        $this->foundArticle = $this->action->run($this->transporter);
    }

    public function test_FindArticleByIdAction()
    {
        $this->assertInstanceOf(Article::class, $this->article, 'The returned object is not an instance of the Article.');

        $this->assertEquals($this->article->id, $this->foundArticle->id);
        $this->assertEquals($this->article->title, $this->foundArticle->title);
        $this->assertEquals($this->article->text, $this->foundArticle->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->action);
        unset($this->article);
        unset($this->data);
        unset($this->transporter);
        unset($this->foundArticle);
    }
}
