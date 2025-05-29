<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatCuti extends Model
{
    protected $table = 'riwayat_cutis';

    protected $fillable = [
        'cuti_id',
        'tanggal_update',
        'status',
        'keterangan',
    ];

    public function cuti()
    {
        return $this->belongsTo(Cuti::class, 'cuti_id');
    }
}
