<?php

namespace App\Containers\Storage\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class DownloadConversionFilesRequest.
 */
class DownloadConversionFilesRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Storage\Data\Transporters\DownloadConversionFilesTransporter::class;

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
        'id',
        'resource_name',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'resource_name' => 'required',
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
