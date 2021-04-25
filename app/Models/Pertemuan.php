<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertemuan extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "pertemuan";
    protected $fillable = ["name","tanggal","expired_absen","fk_matkul_id"];

    public function matakuliah ()
    {
        return $this->belongsTo(Matakuliah::class,'fk_matkul_id','id');
    }
}
