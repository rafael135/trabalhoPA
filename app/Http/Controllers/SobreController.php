<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SobreController extends Controller
{
    //

    function index(Request $request) {
        $loggedUser = Auth::user();

        return view("sobre", [
            "loggedUser" => $loggedUser
        ]);
    }
}
