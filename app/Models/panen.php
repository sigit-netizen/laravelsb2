<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class panen extends Model
{
    use HasFactory;
    protected $table = 'panen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_panen',
        'tanggal_panen',
        'jumlah_panen',
    ];
}
