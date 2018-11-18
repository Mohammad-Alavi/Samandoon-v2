<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Exceptions\CreateResourceFailedException;
use Illuminate\Support\Facades\App;

/**
 * Class CreateArticleTaskTest.
 *
 * @group article
 * @group unit
 */
class CreateArticleTaskTest extends TestCase
{
    /** @var CreateArticleTask $createArticleTask */
    private $createArticleTask;
    /** @var array $data */
    private $data;

    public function setUp()
    {
        parent::setUp();

        $this->createArticleTask = App::make(CreateArticleTask::class);
        $this->data = TestCase::RAW_ARTICLE_DATA;
    }

    public function test_CreateArticleAndReturnAnArticleObject()
    {
        $input = $this->data;
        $actual = $this->createArticleTask->run($input);
        $expected = Article::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of the Article.');
    }

    public function test_ValidateCreatedArticleData()
    {
        $input = $this->data;
        $actual = $this->createArticleTask->run($input);
        $expected = $input;

        $this->assertEquals($expected['title'], $actual->title);
        $this->assertEquals($expected['text'], $actual->text);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->createArticleTask);
        unset($this->data);
    }
}
