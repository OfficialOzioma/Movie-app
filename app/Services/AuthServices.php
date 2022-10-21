<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthServices
{


    public function login($email = null, $password = null)
    {
        $email = $email;
        $password = $password;


        $checkUser = User::where('email', $email)->first();

        if (empty($checkUser)) {

            return [
                "status" => 'error',
                "message" => "User account not found",
            ];
        }

        if (Hash::check($password, $checkUser['password'])) {

            Auth::loginUsingId($checkUser['id']);

            return [
                "status" => 'success',
                "message" => "Login Successfully",
            ];
        } else {

            return [
                "status" => 'error',
                "message" => "Password wrong",
            ];
        }
    }


    public function register($userData)
    {

        $hashPassword = Hash::make($userData['password']);

        $user = new User();

        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = $hashPassword;
        $saveUser =  $user->save();

        if ($saveUser) {
            Auth::loginUsingId($user['id'], true);

            return [
                "status" => 'success',
                "message" => "success created an account",
            ];
        }


        return [
            "status" => 'error',
            "message" => "We cant create this account",
        ];
    }
}
