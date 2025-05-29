<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JatahCuti extends Model
{
    protected $table = 'jatah_cutis';

    protected $fillable = [
        'users_id',
        'tahun',
        'total_jatah',
        'sisa_jatah',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'users_id');
    }
}
