<?php

namespace App\Http\Requests\API;

use App\Models\Product_version;
use InfyOm\Generator\Request\APIRequest;

class CreateProduct_versionAPIRequest extends APIRequest
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
        return Product_version::$rules;
    }
}
