<?php

namespace App\Containers\Content\Tests\Unit;

use App\Containers\Content\Exceptions\AddOnTypeNotFoundException;
use App\Containers\Content\Tasks\ExtractAddOnDataTask;
use App\Containers\Content\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;

class ExtractAddOnArrayTaskTest extends TestCase {

    /**
     * @var ExtractAddOnDataTask
     */
    private $extractAddOnArrayTask;

    public function setUp() {
        parent::setUp();

        $this->extractAddOnArrayTask = new ExtractAddOnDataTask();
    }

    public function test_CheckIdReturnsCorrectDataForAddOnArticle() {
        $transporter = new DataTransporter([
            'article' => [
                'title' => 'This is my title!',
                'text'  => 'This is my text!',
            ],
        ]);

        $sanitizedData = $this->extractAddOnArrayTask->run($transporter, 'article');

        $this->assertEquals('This is my title!', $sanitizedData['title'], 'Tak is not returning title correct');
        $this->assertEquals('This is my text!', $sanitizedData['text'], 'Tak is not returning text correct');
    }

    public function test_ShouldThrowExceptionOnWrongAddOnType() {
        $transporter = new DataTransporter([
            'sth' => [
                'sth' => 'This is sth',
            ],
        ]);

        $this->expectException(AddOnTypeNotFoundException::class);

        $sanitizedData = $this->extractAddOnArrayTask->run($transporter, 'wrong-addOn-type');
    }
}
