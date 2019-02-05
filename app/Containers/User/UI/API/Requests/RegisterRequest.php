<?php

namespace App\Containers\User\UI\API\Requests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Requests\Request;

class RegisterRequest extends Request {

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
    ];

    /**
     * @return  array
     */
    public function rules() {
        $isOneTimePassword = Apiato::call('Authentication@GetAllowedLoginPasswordTypeTask') == 'one_time_password';
        $passwordRule = $isOneTimePassword ? '' : 'min:6|max:30';

        return [
            'phone'    => 'size:13|regex:/(\+989)[0-9]/',
            'email'    => 'email',
            'password' => $passwordRule];
    }

    /**
     * @return  bool
     */
    public function authorize() {
        return $this->check([
            'hasAccess',
        ]);
    }
}
