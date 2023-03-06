<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

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

//        return [
//            'game_id' => ['required','int'],
//            'start_date' => ['required','date','date_format:Y-m-d','after_or_equal:'.Carbon::now()->format('Y-m-d')],
//            'start_time' => ['required','after:'.Carbon::now()->format('H:i:s')],
//        ];
    }
}
