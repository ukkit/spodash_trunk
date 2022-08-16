<?php

namespace App\Http\Requests;

use App\Models\Database_type;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDatabase_typeRequest extends FormRequest
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
        return Database_type::$rules;
    }
}
