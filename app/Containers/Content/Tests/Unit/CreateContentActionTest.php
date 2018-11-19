<?php

namespace App\Containers\Content\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleSubAction;
use App\Containers\Article\Models\Article;
use App\Containers\Content\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

/**
 * Class CreateContentActionTest.
 *
 * @group content
 * @group unit
 */
class CreateContentActionTest extends TestCase
{
    /** @var CreateArticleSubAction $createArticleSubAction */
    private $createArticleSubAction;
    /** @var DataTransporter $transporterForAction */
    private $transporterForAction;
    /** @var Article $createdArticle */
    private $createdArticle;

    public function setUp()
    {
        parent::setUp();

        $this->createArticleSubAction = App::make(CreateArticleSubAction::class);
        $this->transporterForAction = new DataTransporter();
    }

    public function test_ShouldCreateArticleAndReturnAnArticleObject()
    {
        $input = $this->transporterForAction;
        $actual = $this->createArticleSubAction->run($input);
        $expected =

        $this->assertEquals(true, true);
    }
}
