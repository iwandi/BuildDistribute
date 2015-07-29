<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BuildApiRequest extends Request
{
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
            'project' => 'required|min:3|max:255|alpha_dash',  
            'installUrl' => 'required|url|max:1024',            
            'version' => 'required|max:255',
            'platform' => 'required|max:255|string',
            'revision' => 'required|max:255',
            'androidBundleVersionCode' => 'max:255',
            'iPhoneBundleIdentifier' => 'max:1024',
            'iPhoneBundleVersion' => 'max:1024',
            'iPhoneTitle' => 'max:255'
        ];
    }
}
