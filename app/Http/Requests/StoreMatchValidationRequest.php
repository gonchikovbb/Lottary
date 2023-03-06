<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMatchValidationRequest extends FormRequest
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
            'game_id' => 'required|int',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:'.Carbon::now()->format('Y-m-d'),
            'start_time' => 'required|after:'.Carbon::now()->format('H:i:s'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'game_id.required' => 'GameId is required',
            'start_date.required' => 'Date is required',
            'start_time.required' => 'Time is required',
            'start_time.after' => 'The time must be a time after '. Carbon::now()->format('H:i:s') .'.'
        ];
    }
}
