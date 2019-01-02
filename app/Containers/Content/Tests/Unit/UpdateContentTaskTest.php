<?php

namespace App\Containers\Content\Tests\Unit;

use App\Containers\Content\Models\Content;
use App\Containers\Content\Tasks\CreateContentTask;
use App\Containers\Content\Tasks\UpdateContentTask;
use App\Containers\Content\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class UpdateContentTaskTest.
 *
 * @group content
 * @group unit
 */
class UpdateContentTaskTest extends TestCase
{
    /** @var CreateContentTask $updateContentTask */
    private $updateContentTask;

    public function setUp()
    {
        parent::setUp();

        $this->updateContentTask = App::make(UpdateContentTask::class);
    }

    public function test_ShouldUpdateContentAndReturnAnContentObject()
    {
        $input = [];
        $actual = $this->updateContentTask->run($input);
        $expected = Content::class;

        $this->assertInstanceOf($expected, $actual, 'The returned object is not an instance of the Content');
    }

    public function test_ValidateCreatedContentData()
    {
        $input = [];
        $actual = $this->updateContentTask->run($input);
        $expected = $actual->id;

        $this->assertNotEmpty($expected);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->updateContentTask);
    }
}
