<?php

namespace App\Containers\Transaction\UI\API\Requests;

use App\Containers\Transaction\Data\Transporters\CreateTransactionTransporter;
use App\Ship\Parents\Requests\Request;

class CreateTransactionRequest extends Request {

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = CreateTransactionTransporter::class;

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
        // 'id',
    ];

    /**
     * @return  array
     */
    public function rules() {
        return [
            // 'id' => 'required',
            // '{user-input}' => 'required|max:255',
            'amount' => 'required|integer'
        ];
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
