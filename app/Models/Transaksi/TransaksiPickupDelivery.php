<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPickupDelivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaksi_id',
        'pickup_delivery_id'
    ];
}
