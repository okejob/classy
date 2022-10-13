<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertPickupDeliveryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'ambil' => 'boolean',
            'alamat_ambil' => 'nullable|string',
            'driver_ambil_id' => 'nullable|exists:users,id',
            'antar' => 'boolean',
            'alamat_antar' => 'nullable|string',
            'driver_antar_id' => 'nullable|exists:users,id',
            'terambil' => 'boolean',
            'terantar' => 'boolean',
        ];
    }
}
