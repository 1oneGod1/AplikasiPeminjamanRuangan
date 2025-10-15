<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Hanya user yang sudah login yang bisa membuat booking
        return auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'room_id' => [
                'required',
                'integer',
                'exists:rooms,id',
                // Custom rule untuk memastikan ruangan aktif
                Rule::exists('rooms', 'id')->where(function ($query) {
                    $query->where('is_active', true);
                }),
            ],
            'booking_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'start_time' => [
                'required',
                'date_format:H:i:s',
            ],
            'end_time' => [
                'required',
                'date_format:H:i:s',
                'after:start_time',
            ],
            'purpose' => [
                'required',
                'string',
                'min:10',
                'max:500',
            ],
            'participants' => [
                'required',
                'integer',
                'min:1',
                'max:200',
            ],
            'is_recurring' => [
                'nullable',
                'boolean',
            ],
            'recurring_pattern' => [
                'nullable',
                'required_if:is_recurring,true',
                'string',
                'in:daily,weekly,monthly',
            ],
            'rejection_reason' => [
                'nullable',
                'required_if:status,rejected',
                'string',
                'max:500',
            ],
        ];

        // Jika ini adalah update dan user adalah admin
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            if (auth::user()?->role === 'admin') {
                $rules['status'] = [
                    'nullable',
                    'string',
                    Rule::in(['pending', 'approved', 'rejected', 'cancelled', 'completed']),
                ];
            }
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'room_id.required' => 'Ruangan harus dipilih.',
            'room_id.exists' => 'Ruangan yang dipilih tidak ditemukan atau tidak aktif.',
            'booking_date.required' => 'Tanggal peminjaman harus diisi.',
            'booking_date.after_or_equal' => 'Tanggal peminjaman tidak boleh kurang dari hari ini.',
            'start_time.required' => 'Jam mulai harus diisi.',
            'start_time.date_format' => 'Format jam mulai tidak valid (harus HH:MM:SS).',
            'end_time.required' => 'Jam selesai harus diisi.',
            'end_time.date_format' => 'Format jam selesai tidak valid (harus HH:MM:SS).',
            'end_time.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            'purpose.required' => 'Tujuan peminjaman harus diisi.',
            'purpose.min' => 'Tujuan peminjaman minimal 10 karakter.',
            'purpose.max' => 'Tujuan peminjaman maksimal 500 karakter.',
            'participants.required' => 'Jumlah peserta harus diisi.',
            'participants.min' => 'Jumlah peserta minimal 1 orang.',
            'participants.max' => 'Jumlah peserta maksimal 200 orang.',
            'recurring_pattern.required_if' => 'Pola pengulangan harus dipilih jika peminjaman berulang.',
            'recurring_pattern.in' => 'Pola pengulangan harus salah satu dari: daily, weekly, monthly.',
            'rejection_reason.required_if' => 'Alasan penolakan harus diisi ketika status ditolak.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'room_id' => 'ruangan',
            'booking_date' => 'tanggal peminjaman',
            'start_time' => 'jam mulai',
            'end_time' => 'jam selesai',
            'purpose' => 'tujuan peminjaman',
            'participants' => 'jumlah peserta',
            'is_recurring' => 'peminjaman berulang',
            'recurring_pattern' => 'pola pengulangan',
            'rejection_reason' => 'alasan penolakan',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Pastikan format time sudah benar dengan menambahkan detik jika tidak ada
        if ($this->has('start_time') && strlen($this->start_time) === 5) {
            $this->merge([
                'start_time' => $this->start_time . ':00',
            ]);
        }

        if ($this->has('end_time') && strlen($this->end_time) === 5) {
            $this->merge([
                'end_time' => $this->end_time . ':00',
            ]);
        }

        // Set default untuk is_recurring jika tidak ada
        if (!$this->has('is_recurring')) {
            $this->merge([
                'is_recurring' => false,
            ]);
        }
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validasi tambahan: cek apakah peserta tidak melebihi kapasitas ruangan
            if ($this->room_id && $this->participants) {
                $room = \App\Models\Room::find($this->room_id);

                if ($room && $this->participants > $room->capacity) {
                    $validator->errors()->add(
                        'participants',
                        "Jumlah peserta ({$this->participants}) melebihi kapasitas ruangan ({$room->capacity})."
                    );
                }
            }

            // Validasi tambahan: cek durasi peminjaman tidak lebih dari 12 jam
            if ($this->start_time && $this->end_time) {
                $start = \Carbon\Carbon::parse($this->start_time);
                $end = \Carbon\Carbon::parse($this->end_time);
                $duration = $end->diffInHours($start);

                if ($duration > 12) {
                    $validator->errors()->add(
                        'end_time',
                        'Durasi peminjaman tidak boleh lebih dari 12 jam.'
                    );
                }
            }
        });
    }
}
