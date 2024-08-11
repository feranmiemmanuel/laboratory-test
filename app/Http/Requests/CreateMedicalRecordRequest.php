<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMedicalRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'x_ray' => 'required|array',
            'x_ray.*' => 'string',
            'ultrasound_scan' => 'required|array',
            'ultrasound_scan.*' => 'string',
            'ct_scan' => 'required|in:true,false',
            'mri' => 'required|in:true,false'
        ];
    }
}
