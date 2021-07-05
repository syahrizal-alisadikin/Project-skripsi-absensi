<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use HasFactory,SoftDeletes;

    protected $table = "dosen";
    protected $fillable = [
        'name', 'email', 'phone','password','nidn','alamat'
    ];
}
