<?php

namespace App\Containers\Content\Tests\Unit;

use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Containers\Content\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class CreateContentTaskTest.
 *
 * @group content
 * @group unit
 */
class CreateContentTaskTest extends TestCase
{
    /** @var CreateContentTask $createContentTask */
    private $createContentTask;

    public function setUp()
    {
        parent::setUp();

        $this->createContentTask = App::make(CreateContentTask::class);
    }

    public function test_ShouldCreateContentAndReturnAnContentObject()
    {
        $input = [];
        $actual = $this->createContentTask->run($input);
        $expected = Content::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of the Content');
    }

    public function test_ValidateCreatedContentData()
    {
        $input = [];
        $actual = $this->createContentTask->run($input);
        $expected = $actual->id;

        $this->assertNotEmpty($expected);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->createContentTask);
    }
}
