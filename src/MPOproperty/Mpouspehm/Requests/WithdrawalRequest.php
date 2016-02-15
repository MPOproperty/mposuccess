<?php

namespace MPOproperty\Mpouspehm\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawalRequest extends AbstractRequest
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
            'price_conclusion' => 'required|numeric|max:9999999|isMoney:' . $this->user->id,
            'description_conclusion'=>'required|max:250',
            'date_conclusion'=>'required|date',
            'method_conclusion'=>'required',
        ];
    }
}
