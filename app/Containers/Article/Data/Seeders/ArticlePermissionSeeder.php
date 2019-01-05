<?php

namespace App\Containers\Article\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class ArticlePermissionSeeder
 *
 * @package App\Containers\Article\Data\Seeders
 */
class ArticlePermissionSeeder extends Seeder {

    public function run() {
        /*
        |--------------------------------------------------------------------------
        | Article permissions
        |--------------------------------------------------------------------------
        |
        | Here we define permissions needed to use routes related to Article:
        |
        | [+] 'create-article' => is required for user to be allowed to create new articles
        |
        | [+] 'update-article' => is required for user to be allowed to update articles
        |
        | [+] 'delete-article' => is required for user to be allowed to delete an existing article
        |
        */
        Apiato::call('Authorization@CreatePermissionTask', ['create-article', 'Create Article']);
        Apiato::call('Authorization@CreatePermissionTask', ['update-article', 'Update Article']);
        Apiato::call('Authorization@CreatePermissionTask', ['delete-article', 'Delete Article']);
    }
}
