<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $fillable = [
        'name_kelas',
    ];
    
    protected $table = 'kelas';

    public function murids()
    {
        return $this->hasMany(kelas::class, 'kelas_id');
    }
    
}
