<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    function __construct()
    {
        if(Auth::check() == true) {
            return Redirect::to("/");
        }
    }


    function registerView(Request $request) {
        $errors = $request->session()->get("errors", null);

        return view("auth.register", [
            "errors" => $errors
        ]);
    }

    function registerAction(RegisterRequest $request) {
        $isAuthenticated = $request->authenticate();

        if($isAuthenticated == true) {
            $request->session()->regenerate();
        } else {
            return redirect()->route("register")->with("errors", []);
        }

        return redirect()->intended("/");
    }

    function loginView(Request $request) {
        $errors = $request->session()->get("errors", null);

        return view("auth.login", [
            "errors" => $errors
        ]);
    }

    function loginAction(LoginRequest $request) {
        $isAuthenticated = $request->authenticate();

        if($isAuthenticated == true) {
            $request->session()->regenerate();
        } else {
            return redirect()->route("login")->with("errors", []);
        }

        return redirect()->intended("/");
    }
}
