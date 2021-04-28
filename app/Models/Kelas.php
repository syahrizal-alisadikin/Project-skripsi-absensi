<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "kelas";

    protected $fillable = ["name","fk_matkul_id","fk_dosen_id","fk_semester_id","fk_jurusan_id"];

    public function matkul()
    {
        return $this->belongsTo(Matakuliah::class,'fk_matkul_id','id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,'fk_dosen_id','id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class,'fk_semester_id','id');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'fk_jurusan_id','id');
    }
}
