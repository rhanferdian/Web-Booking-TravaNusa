<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tour_id' => ['required', 'exists:tours,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'travel_date' => ['required', 'date'],
            'total_pax' => ['required', 'integer', 'min:1', 'max:50'],
            'status' => ['required', 'in:pending,confirmed,canceled'],
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'tour_id' => 'paket wisata',
            'customer_name' => 'nama lengkap',
            'customer_phone' => 'nomor telepon',
            'travel_date' => 'tanggal keberangkatan',
            'total_pax' => 'jumlah peserta',
            'status' => 'status booking',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'tour_id.required' => 'Paket wisata wajib dipilih.',
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_phone.required' => 'Nomor telepon wajib diisi.',
            'travel_date.required' => 'Tanggal keberangkatan wajib diisi.',
            'total_pax.required' => 'Jumlah peserta wajib diisi.',
            'total_pax.min' => 'Minimal 1 peserta.',
            'total_pax.max' => 'Maksimal 50 peserta.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ];
    }
}
