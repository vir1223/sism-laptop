<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bidang extends Model
{
    protected $fillable = [
        'name_bidang',
    ];

    protected $table = 'bidangs';

    public function perizinans()
    {
        return $this->hasMany(perizinan::class, 'bidang_id');
    }
    public function gurus()
    {
        return $this->hasMany(guru::class, 'bidang_id');
    }
}
