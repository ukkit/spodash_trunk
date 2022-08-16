<?php

namespace App\Http\Requests;

use App\Models\Pai_build;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePai_buildRequest extends FormRequest
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
        $rules = Pai_build::$rules;

        return $rules;
    }
}
