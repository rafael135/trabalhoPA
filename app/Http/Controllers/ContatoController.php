<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    //

    function index(Request $request) {


        return view("contato");
    }
}
