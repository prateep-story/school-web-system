<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AwardRequest extends FormRequest
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
          'portfolio' => 'required|max:255',
          'title' => 'required|max:255',
          'subtitle' => 'required|max:255',
          'award' => 'required|max:255',
          'competition' => 'required|max:255',
          'institution' => 'required|max:255',
          'year' => 'required|integer'
        ];
    }
}
