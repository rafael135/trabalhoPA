<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreController extends Controller
{
    //

    function index(Request $request) {


        return view("sobre");
    }
}
