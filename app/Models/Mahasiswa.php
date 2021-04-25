<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "mahasiswa";
    protected $fillable = [
        'name', 'email', 'phone','nim','password','fk_semester_id','fk_jurusan_id'
    ];

    protected $hidden = ['password'];

    public function semester()
    {
        return $this->hasOne(Semester::class,'id','fk_semester_id');
    }

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class,'id','fk_jurusan_id');
    }
}
