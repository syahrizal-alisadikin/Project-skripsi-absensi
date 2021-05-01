<?php

namespace App\Models;

use App\Http\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absen extends Model
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
    
    protected $table = "absen";

    protected $fillable = ["fk_pertemuan_id","fk_mahasiswa_id","status","waktu"];

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class,'fk_pertemuan_id','id');
    }

    public function mahasiswa ()
    {
        return $this->belongsTo(Mahasiswa::class,'fk_mahasiswa_id','id');
    }
}
