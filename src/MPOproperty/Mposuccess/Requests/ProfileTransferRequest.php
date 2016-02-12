<?php

namespace MPOproperty\Mposuccess\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileTransferRequest extends AbstractRequest
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
            'price_transfer' => 'required|numeric|max:9999999|isMoney:' . $this->user->id,
            'user_transfer_to' => 'required|numeric|transfer:' .  $this->user->id . ',' . $postData["user_transfer_to"],
            'description'=>'required|max:250',
        ];
    }
}
