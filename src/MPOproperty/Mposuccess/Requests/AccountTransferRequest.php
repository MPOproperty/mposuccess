<?php

namespace MPOproperty\Mposuccess\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountTransferRequest extends AbstractRequest
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
            'price_transfer' => 'required|numeric|max:9999999|isMoney:' . $postData["user_transfer_from"],
            'user_transfer_from' => 'required|numeric|transfer:' .  $postData["user_transfer_from"] . ',' . $postData["user_transfer_to"],
            'user_transfer_to' => 'required|numeric',
        ];
    }
}
