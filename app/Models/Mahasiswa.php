<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;	

class Mahasiswa extends Authenticatable implements JWTSubject
{
    use HasFactory,SoftDeletes;
    protected $table = "mahasiswa";
    protected $fillable = [
        'name','angkatan', 'email', 'phone','nim','password','fk_semester_id','fk_jurusan_id'
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

     public function getJWTIdentifier()
    {
        return $this->getKey();
    }
        
    /**
     * getJWTCustomClaims
     *
     * @return void
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
