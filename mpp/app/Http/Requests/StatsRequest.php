<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'statistics' => 'required|array',
            'statistics.*.basketballer_name' => 'required|string',
            'statistics.*.date' => 'required|date',
            'statistics.*.note' => 'required|numeric',
            'statistics.*.points' => 'required|int'
        ];
    }
}
