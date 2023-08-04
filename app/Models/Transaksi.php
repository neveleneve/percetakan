<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_transaksi',
        'tipe_transaksi',
        'total_transaksi',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function detail()
    {
        $this->hasMany(DetailTransaksi::class);
    }
}
