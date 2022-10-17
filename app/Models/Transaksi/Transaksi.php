<?php

namespace App\Models\Transaksi;

use App\Models\Data\Pelanggan;
use App\Models\Outlet;
use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        User::observe(new UserActionObserver);
    }

    public function scopeDetail($query)
    {
        return $query->with('item_transaksi');
    }

    public function item_transaksi()
    {
        return $this->hasMany(ItemTransaksi::class);
    }

    public function pickup_delivery()
    {
        return $this->hasOne(PickupDelivery::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function parfum()
    {
        return $this->hasOne(Parfum::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
