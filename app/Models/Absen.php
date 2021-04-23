<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absen extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "absen";

    protected $fillable = ["fk_pertemuan_id","fk_mahasiswa_id","status","waktu"];
}
