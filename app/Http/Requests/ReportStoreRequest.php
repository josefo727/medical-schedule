<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
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
            'record' => ['required', 'max:255', 'string'],
            'evaluation' => ['required', 'max:255', 'string'],
            'diagnosis' => ['required', 'max:255', 'string'],
            'recommendations' => ['required', 'max:255', 'string'],
            'medical_appointment_id' => [
                'required',
                'exists:medical_appointments,id',
            ],
        ];
    }
}
