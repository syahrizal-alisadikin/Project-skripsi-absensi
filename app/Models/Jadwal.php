<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "jadwal";

    protected $fillable = ["fk_kelas_id","fk_mahasiswa_id"];

    public function mahasiswa ()
    {
        return $this->belongsTo(Mahasiswa::class,'fk_mahasiswa_id','id');
    }

    public function kelas ()
    {
        return $this->belongsTo(Kelas::class,'fk_kelas_id','id');
    }
}
