<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertItemTransaksiRequest extends FormRequest
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
            'transaksi_id' => 'required|exists:transaksis,id',
            'jenis_item_id' => 'required|exists:jenis_items,id',
            'express' => 'boolean',
            'setrika' => 'boolean',
            'harga_premium' => 'numeric',
            'status_proses' => 'string',
            'pencuci' => 'exists:users,id',
            'penyetrika' => 'exists:users,id',
        ];
    }
}
