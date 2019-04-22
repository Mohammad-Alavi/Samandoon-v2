<?php

namespace App\Containers\Tag\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class SearchTagRequest.
 */
class SearchTagRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Tag\Data\Transporters\SearchTagTransporter::class;

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
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
//         'q',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'q' => 'required',
            'tag_type' => 'required|in:' .
                config('samandoon.tag_type.content') . ',' .
                config('samandoon.tag_type.subject'),
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
