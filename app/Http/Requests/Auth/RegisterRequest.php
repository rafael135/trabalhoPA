<?php

namespace App\Http\Requests;

use App\Exceptions\AuthException;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string"],
            "email" => ["required", "string", "email"],
            "password" => ["required", "string"],
            "passwordConfirm" => ["required", "string"]
        ];
    }

    public function authenticate(Request $request) {
        $name = $this->input("name");
        $email = $this->input("email");
        $password = $this->input("password");
        $passwordConfirm = $this->input("passwordConfirm");

        if($password != $passwordConfirm) {
            return redirect("/register")->with("errors", [
                "differentPassword" => true
            ]);
        }

        try {
            User::create([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password)
            ]);
        } catch(Exception $ex) {

        }
        

        $success = Auth::attempt([
            "email" => $email,
            "password" => $password
        ]);

        return $success;
        
    }
}
