<?php

namespace App\Models\Transaksi;

use App\Models\Data\JenisItem;
use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        ItemTransaksi::observe(new UserActionObserver);
    }

    public function jenis_item()
    {
        return $this->belongsTo(JenisItem::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
