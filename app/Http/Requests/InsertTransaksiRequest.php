<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertTransaksiRequest extends FormRequest
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
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'outlet_input_id' => 'exists:outlets,id',
            'cashier_id' => 'exists:users,id',
            'pickup_delivery_id' => 'exists:pickup_deliveries,id',
            'parfum_id' => 'exists:parfums,id',
            'express' => 'boolean',
            'setrika_only' => 'boolean',
            'item_transaksi' => 'array',
        ];
    }
}
