<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    //

    function index(Request $request) {


        return view("produto");
    }
}
