<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class perizinan extends Model
{
    protected $fillable = [
        'user_id',
        'murid_id',
        'guru_id',
        'alasan',
        'tanggal_izin',
        'sesi',
        'persetujuan',
    ];
    protected $table = 'perizinans';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'murid_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}
