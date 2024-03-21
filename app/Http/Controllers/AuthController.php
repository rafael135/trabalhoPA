<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    function registerView(Request $request) {
        $errors = $request->session()->get("errors", null);

        return view("auth.register", [
            "errors" => $errors
        ]);
    }

    function registerAction(RegisterRequest $request) {
        $isAuthenticated = $request->authenticate($request);

        if($isAuthenticated == false) {
            
        }

        return Redirect::to("/", 302);
    }

    function loginView(Request $request) {
        $errors = $request->session()->get("errors", null);

        return view("auth.login", [
            "errors" => $errors
        ]);
    }

    function loginAction(Request $request) {

    }
}
