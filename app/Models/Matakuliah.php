<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matakuliah extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "matakuliah";
    protected $fillable = ["name","sks",'id_matkul','tahun'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class,'fk_matkul_id','id');
    }
}
