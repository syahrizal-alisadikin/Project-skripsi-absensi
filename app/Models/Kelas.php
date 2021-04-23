<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "kelas";

    protected $fillable = ["name","fk_matkul_id","fk_dosen_id","fk_semester_id"];
}
