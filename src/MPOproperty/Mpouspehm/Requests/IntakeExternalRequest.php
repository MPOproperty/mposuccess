<?php

namespace MPOproperty\Mpouspehm\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class IntakeExternalRequest extends AbstractRequest
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price_intake' => 'required|numeric|max:9999999',
            'user_to' => 'required|numeric',
        ];
    }
}
