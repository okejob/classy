<?php

namespace App\Models\Packing;

use App\Models\Transaksi\PickupDelivery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function packing_inventories()
    {
        return $this->hasMany(PackingInventory::class);
    }

    public function modified_by()
    {
        return $this->belongsTo(User::class);
    }

    public function pickup_delivery()
    {
        return $this->belongsTo(PickupDelivery::class);
    }
}
