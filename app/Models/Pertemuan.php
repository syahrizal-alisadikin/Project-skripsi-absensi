<?php

namespace App\Models;

use App\Http\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertemuan extends Model
{
    use HasFactory,SoftDeletes,Uuid;
    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
    protected $table = "pertemuan";
    protected $fillable = ["name","tanggal","expired_absen","fk_matkul_id"];

    public function matakuliah ()
    {
        return $this->belongsTo(Matakuliah::class,'fk_matkul_id','id');
    }

    public function absen()
    {
        return $this->hasOne(Absen::class,'id','fk_matkul_id');
    }
}
