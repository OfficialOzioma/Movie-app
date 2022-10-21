<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\AuthServices;
use App\Traits\RequestResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use RequestResponse;

    /**
     * @var AuthServices
     */
    public  $authServices;

    public  function __construct()
    {
        $this->authServices = new AuthServices();
    }

    /**
     * shows the form for user login and registration
     *
     * @return Application|Factory|View
     */
    public function auth_form()
    {
        return view('auth.auth_form');
    }


    /**
     *  This method Authenticates the user
     *  using the credentials of the user
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required',
            'password' => 'bail|required',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), []);
        }

        $email = $request->email;
        $password = $request->password;

        $userlogin = $this->authServices->login($email, $password);

        if ($userlogin['status'] == 'error') {
            return $this->error($userlogin['message'], []);
        }

        return $this->success($userlogin['message'], [], '/dashboard');
    }

    /**
     * This method saves the users details in the database
     * and authenticates the user
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'email' => 'bail|required|unique:users',
            'password' => 'bail|required|same:confirm_password',
            'confirm_password' => 'bail|required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), []);
        }


        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];


        $register = $this->authServices->register($userData);

        if ($register['status'] == 'error') {
            return $this->error($register['message'], []);
        }

        return $this->success($register['message'], [], '/dashboard');
    }


    /**
     * this method logout the user from the system
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/')->with(['status' => 'success', 'message' => 'logout successful']);
    }
}
