<?php

namespace App\Containers\Content\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateContentRequest.
 */
class CreateContentRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Content\Data\Transporters\CreateContentTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
//        'id',
        'repost.referenced_content_id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
//        'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
//            'id' => 'required',
//            'article.title' => 'required',
//            'article.text' => 'required',
            'addon.article' => 'required',
            'addon.subject' => 'required',
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
