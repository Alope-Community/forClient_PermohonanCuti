<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function riwayatCuti()
    {
        return $this->hasMany(RiwayatCuti::class, 'cuti_id');
    }
}
