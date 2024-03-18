<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function registerView(Request $request) {
        return view("register");
    }

    function registerAction(Request $request) {

    }

    function loginView(Request $request) {
        return view("");
    }

    function loginAction(Request $request) {

    }
}
