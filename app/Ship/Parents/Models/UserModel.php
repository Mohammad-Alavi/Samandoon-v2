<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

abstract class UserModel extends AbstractUserModel {

    use Notifiable;
    use SoftDeletes;
    use HashIdTrait;
    use HasRoles;
    use HasApiTokens;
    use HasResourceKeyTrait;

    /**
     * @param $identifier
     * @return UserModel|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function findForPassport($identifier) {
        $allowedLoginUsernameFields = Apiato::call('Authentication@GetAllowedLoginUsernameTypesTask');

        $builder = $this;

        foreach ($allowedLoginUsernameFields as $field) {
            $builder = $builder->orWhere($field, $identifier);
        }

        $builder = $builder->first();

        return $builder;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        $allowedLoginPasswordField = Apiato::call('Authentication@GetAllowedLoginPasswordTypeTask');

        switch ($allowedLoginPasswordField) {
            case 'one_time_password':
                return $this->one_time_password;
            case 'password':
                return $this->password;
            default:
                return $this->password;
        }

    }

}
