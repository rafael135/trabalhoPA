<?php

namespace App\Http\Requests;

use App\Exceptions\AuthException;
use App\Models\State;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
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
            "passwordConfirm" => ["required", "string"],
            "state" => ["required", "string"]
        ];
    }

    public function authenticate() {
        $name = $this->input("name");
        $email = $this->input("email");
        $password = $this->input("password");
        $passwordConfirm = $this->input("passwordConfirm");
        $state_acronym = $this->input("state");

        //dd($name, $email, $password, $passwordConfirm, $state_acronym);

        if($password != $passwordConfirm) {
            return redirect("/register")->with("errors", [
                "differentPassword" => true
            ]);
        }

        if($state_acronym == null || $state_acronym == "") {
            return redirect("/register")->with("errors", [
                "invalidState" => true
            ]);
        }

        $state = State::select()->where("state_acronym", "=", $state_acronym)->first();

        if($state == null) {
            return redirect("/register")->with("errors", [
                "invalidState" => true
            ]);
        }

        try {
            User::create([
                "state_id" => $state->id,
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password)
            ]);
        } catch(Exception $ex) {
            
        }
        

        $success = Auth::attempt([
            "email" => $email,
            "password" => $password
        ], true);

        return $success;
        
    }
}
