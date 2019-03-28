<?php

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateUserRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserRequest extends Request
{

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
        'id',
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'id'       => 'required|exists:users,id',
            'first_name'     => 'min:2|max:50',
            'last_name'     => 'min:2|max:50',
            'nick_name'     => 'min:2|max:50',
            'description'     => 'max:150',
            'email'    => 'email|unique:users,email',
            'username'    => 'bail|min:5|max:32|regex:/^[a-zA-Z](?:_?[a-zA-Z0-9]+)*$/|unique:users,username',
            'phone'    => 'size:13|regex:/(\+989)[0-9]/',
            'gender'    => 'in:male,female,unspecified',
            'birth'    => 'date_format:Ymd',
            'avatar'    => 'image|max:1024',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        // is this an admin who has access to permission `update-users`
        // or the user is updating his own object (is the owner).

        return $this->check([
            'hasAccess|isOwner',
        ]);
    }
}
