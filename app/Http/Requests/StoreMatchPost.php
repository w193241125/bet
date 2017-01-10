<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                    'tmMatchId' => 'required|integer|unique:betsys_match_info,tm_match_id'
                ];
            case 'tmLeague':
                return [
                    'division' => 'required|integer',
                    'group' => 'required|integer'
                ];
            case 'customMatch':
                return [
                    'home_name' => 'required|max:100'
                ];
        }
    }
}
