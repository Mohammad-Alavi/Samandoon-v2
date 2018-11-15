<?php

namespace App\Containers\Article\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

class ArticlePermissionSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------
        Apiato::call('Authorization@CreatePermissionTask', ['create-article', 'Create Article']);
        Apiato::call('Authorization@CreatePermissionTask', ['update-article', 'Update Article']);
        Apiato::call('Authorization@CreatePermissionTask', ['delete-article', 'Delete Article']);
    }
}
