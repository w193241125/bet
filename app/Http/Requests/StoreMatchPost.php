<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class StoreMatchPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $type = $this->get('addType');
        switch ($type)
        {
            case 'tmMatch':
                return [
                    'tmMatchId' => 'required|regex:/\d\/?$/|tm_match_id_valid',
                    'winOdds' => 'required|numeric|between:1,999',
                    'drawOdds' => 'required|numeric|between:1,999',
                    'loseOdds' => 'required|numeric|between:1,999',
                ];
            case 'tmLeague':
                return [
                    'division' => 'required|integer|max:5|min:1',
                    'group' => 'required|integer|max:128|min:1'
                ];
            case 'customMatch':
                return [
                    'home_name' => 'required|max:100'
                ];
            default:
                return ['addType'=> 'required|in:tmMatch,tmLeague,customMatch'];
        }
    }

    //custom error msg
    public function messages(){
        return [
            'tmMatchId.regex' => 'tmMatchId must terminate in number',
            "tmMatchId.tm_match_id_valid" => "The match is not exist or was closed"

        ];
    }
}
