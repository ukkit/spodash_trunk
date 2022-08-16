<?php

namespace App\Http\Requests;

use App\Models\Action_history;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAction_historyRequest extends FormRequest
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
        return Action_history::$rules;
    }
}
