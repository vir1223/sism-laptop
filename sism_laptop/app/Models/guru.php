<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    protected $fillable = [
        'user_id',
        'name_guru',
        'nip',
        'bidang_id',
    ];
    protected $table = 'gurus';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function perizinans()
    {
        return $this->hasMany(perizinan::class, 'guru_id');
    }
    
    public function bidang()
    {
        return $this->belongsTo(bidang::class, 'bidang_id');
    }
}
