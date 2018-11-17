<?php

namespace App\Containers\Article\Tests\Unit;

use App;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\DeleteArticleTask;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Exceptions\DeleteResourceFailedException;

/**
 * Class DeleteArticleTaskTest.
 *
 * @group article
 * @group unit
 */
class DeleteArticleTaskTest extends TestCase
{
    /** @var Article $articleForDeletion */
    private $articleForDeletion;
    /** @var DeleteArticleTask $deleteArticleTask */
    private $deleteArticleTask;

    public function setUp()
    {
        parent::setUp();

        // Create new article using helper function
        $this->articleForDeletion = $this->createNewArticleAndSaveItToDBOrFail(TestCase::RAW_ARTICLE_DATA);
        $this->deleteArticleTask = App::make(DeleteArticleTask::class);
    }

    public function test_DeleteArticleAndReturnTrue()
    {
        // Seed a valid id
        $input = $this->articleForDeletion->id;
        $actual = $this->deleteArticleTask->run($input);
        $expected = true;

        $this->assertEquals($expected, $actual);
    }

    public function test_FailToDeleteArticleAndThrowException()
    {
        // Seed an invalid id that is not found in the database
        $input = 999;
        $this->expectException(DeleteResourceFailedException::class);
        $this->deleteArticleTask->run($input);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->articleForDeletion);
        unset($this->deleteArticleTask);
    }
}
