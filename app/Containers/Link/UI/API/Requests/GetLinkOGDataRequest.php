<?php

namespace App\Containers\Link\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class GetLinkOGDataRequest.
 */
class GetLinkOGDataRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Link\Data\Transporters\GetLinkOGDataTransporter::class;

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
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
//         'url',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
             'url' => 'required|url',
             'get_all_meta_data' => 'required|boolean',
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
