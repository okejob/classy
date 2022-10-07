<?php

namespace App\Models\Data;

use App\Models\Transaksi\ItemTransaksi;
use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        User::observe(new UserActionObserver);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function item_transaksi()
    {
        return $this->hasMany(ItemTransaksi::class);
    }
}
