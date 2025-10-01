<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';

    protected $fillable = [
        'user_id',
        'murid_id',
        'guru_id',
        'alasan',
        'tanggal_izin',
        'sesi',
        'persetujuan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function murid()
    {
        return $this->belongsTo(Murid::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
