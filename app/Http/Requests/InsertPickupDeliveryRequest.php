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
            'ambil' => 'boolean',
            'alamat_ambil' => 'nullable|string',
            'driver_ambil_id' => 'nullable|exists:users,id',
            'antar' => 'boolean',
            'alamat_antar' => 'nullable|string',
            'driver_antar_id' => 'nullable|exists:users,id',
            'ambil_di_outlet' => 'boolean',
            'outlet_ambil_id' => 'nullable|exists:outlets,id',
            'terambil' => 'boolean',
            'terantar' => 'boolean',
            'penerima' => 'nullable|string',
            'foto_penerima' => 'nullable|image'
        ];
    }
}
