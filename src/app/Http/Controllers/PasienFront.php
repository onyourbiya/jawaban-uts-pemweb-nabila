<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienFront extends Controller
{
    public function index()
    {
        $pasiens = Pasien::get();
        return view('pasien.index', compact('pasiens'));
    }
}
