<?php

namespace App\Containers\Comment\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class GetAllCommentsRequest.
 */
class GetAllCommentsRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Comment\Data\Transporters\GetAllCommentsTransporter::class;

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
         'content_id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
         'content_id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
             'content_id' => 'required',
            // '{user-input}' => 'required|max:255',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
