<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MainController extends Controller
{
    public function index()
    {
        return view('paginas/index');
    }
}
