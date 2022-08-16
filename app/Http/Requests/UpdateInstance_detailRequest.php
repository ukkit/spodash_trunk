<?php

namespace App\Http\Requests;

use App\Models\Instance_detail;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInstance_detailRequest extends FormRequest
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
        return Instance_detail::$rules;
    }
}
