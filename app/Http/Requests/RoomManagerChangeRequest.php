<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\BookingChangeRequest;

class RoomManagerChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => [
                'required',
                'string',
                Rule::in([
                    BookingChangeRequest::TYPE_EDIT,
                    BookingChangeRequest::TYPE_CANCEL,
                ]),
            ],
            'reason' => ['required', 'string', 'min:10', 'max:500'],
        ];
    }

    /**
     * Custom attribute names for validation messages.
     */
    public function attributes(): array
    {
        return [
            'type' => 'jenis pengajuan',
            'reason' => 'alasan pengajuan',
        ];
    }
}
