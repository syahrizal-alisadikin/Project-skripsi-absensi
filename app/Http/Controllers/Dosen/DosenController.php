<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DosController extends Controller
{
   public function index()
    {
        return view('pages.dosen.dashboard');
    }

    
}
