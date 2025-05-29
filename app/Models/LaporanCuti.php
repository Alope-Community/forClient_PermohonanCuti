<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanCuti extends Model
{
    protected $table = 'laporan_cutis';

    protected $fillable = [
        'cuti_id',
        'nama_karyawan',
        'diterbitkan_oleh',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_hari',
        'alasan',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nama_karyawan');
    }

    public function diterbitkanOleh()
    {
        return $this->belongsTo(User::class, 'diterbitkan_oleh');
    }

    public function cuti()
    {
        return $this->belongsTo(Cuti::class, 'cuti_id');
    }
}
