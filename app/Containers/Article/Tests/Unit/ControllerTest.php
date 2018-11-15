<?php

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tests\TestCase;
use App\Containers\Article\UI\API\Controllers\Controller;
use App\Containers\Article\UI\API\Requests\CreateArticleRequest;
use App\Containers\Article\UI\API\Requests\GetArticleRequest;
use App\Containers\Article\UI\API\Requests\UpdateArticleRequest;
use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use Illuminate\Support\Facades\App;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class ControllerTest.
 *
 * @group article
 * @group unit
 */
class ControllerTest extends TestCase
{
    /** @var Controller $controller */
    private $controller;

    // Requests
    /** @var CreateArticleRequest $createArticleRequest */
    private $createArticleRequest;
    /** @var UpdateArticleRequest $updateArticleRequest */
    private $updateArticleRequest;
    /** @var GetArticleRequest $getArticleRequest */
    private $getArticleRequest;

    // Request Data
    private $createArticleParam;
    private $updateArticleParam;
    private $getArticleParam;

    // Methods
    private $createdArticle;
    private $updatedArticle;
    private $getArticle;

    /** @var array $transformedArticle */
    private $transformedArticle;

    // Article vars for specific tests
    /** @var Article $articleForUpdate */
    private $articleForUpdate;
    /** @var Article $articleToGet */
    private $articleToGet;

    public function setUp()
    {
        parent::setUp();

        // Create and instance of Controller
        $this->controller = App::make(Controller::class);

        // Create new Article for UPDATE test
        $this->articleForUpdate = $this->createNewArticle();
        // Create new Article for GET test
        $this->articleToGet = $this->createNewArticle();


        // Transform Article for GET test
        $this->transformedArticle = $this->controller->transform($this->articleToGet, ArticleTransformer::class);

        // Populate parameters
        $this->createArticleParam = $this->data;
        $this->updateArticleParam = [
            'id' => $this->articleForUpdate->id,
            'title' => 'new title',
            'text' => 'new text',
        ];
        $this->getArticleParam = ['id' => $this->articleToGet->id];

        // Create Requests
        $this->createArticleRequest = CreateArticleRequest::injectData($this->createArticleParam);
        $this->updateArticleRequest = UpdateArticleRequest::injectData($this->updateArticleParam);
        $this->getArticleRequest = GetArticleRequest::injectData($this->getArticleParam);

        // Method Calls
        $this->createdArticle = $this->controller->createArticle($this->createArticleRequest);
        $this->updatedArticle = $this->controller->updateArticle($this->updateArticleRequest);
        $this->getArticle = $this->controller->getArticle($this->getArticleRequest);
    }

    public function test_createArticle()
    {
        $this->assertInternalType('array', $this->createdArticle, 'The returned object should be of type array');
        $this->assertEquals($this->data['title'], $this->createdArticle['data']['title']);
        $this->assertEquals($this->data['text'], $this->createdArticle['data']['text']);
    }

    public function test_updateArticle()
    {
        $this->assertInternalType('array', $this->updatedArticle, 'The returned object should be of type array');
        $this->assertEquals($this->updateArticleParam['id'], (integer)Hashids::decode($this->updatedArticle['data']['id']));
        $this->assertEquals($this->updateArticleParam['title'], $this->updatedArticle['data']['title']);
        $this->assertEquals($this->updateArticleParam['text'], $this->updatedArticle['data']['text']);
    }

    public function test_getArticle()
    {
        $this->assertInternalType('array', $this->getArticle, 'The returned object should be of type array');
        $this->assertEquals($this->transformedArticle, $this->getArticle);
    }
}
