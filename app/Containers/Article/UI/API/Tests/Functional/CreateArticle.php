<?php

namespace App\Containers\Article\UI\API\Tests\Functional;

use App\Containers\Article\Tests\ApiTestCase;

/**
 * Class CreateArticle.
 *
 * @group article
 * @group api
 */
class CreateArticle extends ApiTestCase
{
    // the endpoint to be called within this test (e.g., get@v1/users)
    protected $endpoint = 'post@v1/article';

    /** @var array $data */
    protected $data;

    // fake some access rights
    protected $access = [
        'permissions' => 'create-article',
        'roles' => 'user|admin',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->getTestingUser([
            'email' => 'm.alavi1989@gmail.com',
            'password' => 'secret',
            ],
            $this->access);
    }

    /**
     * @test
     */
    public function test_CreateArticle()
    {
        // create a data object
        $this->data = [
            'title' => $this->faker->realText(80),
            'text' => $this->faker->realText(200),
        ];

        // send the HTTP request
        $response = $this->makeCall($this->data);

        // assert the response status
        $response->assertStatus(200);

        // make other asserts here
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->data);
        unset($this->access);
        unset($this->endpoint);
    }
}
