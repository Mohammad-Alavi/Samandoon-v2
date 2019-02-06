<?php

namespace App\Ship\Parents\Tests\PhpUnit;

use Apiato\Core\Abstracts\Tests\PhpUnit\TestCase as AbstractTestCase;
use App\Containers\Content\Models\Content;
use App\Containers\User\Models\User;
use Faker\Generator;
use Illuminate\Contracts\Console\Kernel as ApiatoConsoleKernel;

/**
 * Class TestCase
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class TestCase extends AbstractTestCase
{
    /**@var Generator $faker */
    protected $faker;

    protected const RAW_ARTICLE_DATA = [
        'title' => 'این یک تایتل زیبا در مورد یک نوشته زیباست',
        'text' => 'این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست این یک تایتل زیبا در مورد یک نوشته زیباست',
    ];

    /**
     * Setup the test environment, before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Reset the test environment, after each test.
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $this->baseUrl = env('API_FULL_URL'); // this reads the value from `phpunit.xml` during testing

        // override the default subDomain of the base URL when subDomain property is declared inside a test
        $this->overrideSubDomain();

        $app = require __DIR__ . '/../../../../../bootstrap/app.php';

        $app->make(ApiatoConsoleKernel::class)->bootstrap();

        // create instance of faker and make it available in all tests
        $this->faker = $app->make(Generator::class);

        return $app;
    }

    /**
     * @param array $data
     *
     * @return Content
     * @throws \Throwable
     */
    protected function createNewContentAndSaveItToDBOrFail()
    {
        $article = new Content();
        $article->saveOrFail();
        return $article;
    }

    /**
     * @param array $data
     *
     * @return User
     * @throws \Throwable
     */
    protected function createNewUserAndSaveItToDBOrFail()
    {
        $user = new User();
        $user->saveOrFail();
        return $user;
    }
}
