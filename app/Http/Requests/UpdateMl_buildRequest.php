<?php

namespace App\Http\Requests;

use App\Models\Ml_build;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMl_buildRequest extends FormRequest
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
        $rules = Ml_build::$rules;

        return $rules;
    }
}
