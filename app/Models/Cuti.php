<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cutis';

    protected $fillable = [
        'users_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status',
        'catatan_penolakan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function riwayatCuti()
    {
        return $this->hasMany(RiwayatCuti::class, 'cuti_id');
    }

    public function laporanCuti()
    {
        return $this->hasMany(LaporanCuti::class, 'cuti_id');
    }
}
