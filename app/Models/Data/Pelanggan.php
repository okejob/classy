<?php

namespace App\Models\Data;

use App\Models\Saldo;
use App\Models\User;
use App\Observers\UserActionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [
        'saldo_akhir'
    ];
    public static function boot()
    {
        parent::boot();
        Pelanggan::observe(new UserActionObserver);
    }

    public function getSaldoAkhirAttribute()
    {
        $saldo = Saldo::where('pelanggan_id', $this->id)->latest()->first();
        if (!$saldo) {
            return 0;
        }
        return $saldo->saldo_akhir;
    }

    public function catatan_pelanggan()
    {
        return $this->hasOne(CatatanPelanggan::class);
    }

    public function saldo()
    {
        return $this->hasMany(Saldo::class);
    }
}
