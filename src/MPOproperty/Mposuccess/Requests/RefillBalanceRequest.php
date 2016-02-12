<?php

namespace MPOproperty\Mposuccess\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefillBalanceRequest extends AbstractRequest
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
            'price_refill' => 'required|numeric|min:1|max:9999999',
            'description_refill'=>'required|max:250',
        ];
    }
}
