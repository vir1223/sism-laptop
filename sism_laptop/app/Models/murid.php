<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class murid extends Model
{
    protected $fillable = [
        'user_id',
        'name_murid',
        'nis',
        'kelas_id',
    ];
    protected $table = 'murids';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function perizinans()
    {
        return $this->hasMany(perizinan::class, 'murid_id');
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }
}
