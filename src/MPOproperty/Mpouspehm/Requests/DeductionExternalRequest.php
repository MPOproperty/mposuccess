<?php

namespace MPOproperty\Mpouspehm\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeductionExternalRequest extends AbstractRequest
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
        $postData = \Request::all();

        return [
            'price_deduction' => 'required|numeric|max:9999999|isMoney:' . $postData["user_from"],
            'user_from' => 'required|numeric',
        ];
    }
}
