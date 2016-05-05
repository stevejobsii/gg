<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HaoliController extends Controller
{

    public function fzzl()
    {
        return view('haoli.fzzl');
    }

    public function szqzl()
    {
        return view('haoli.szqzl');
    }

    public function cljqc()
    {
        return view('haoli.cljqc');
    }

    public function czlfl()
    {
        return view('haoli.czlfl');
    }
}
