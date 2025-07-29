<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log in with username, email, or phone
        $loginField = $this->findLoginField($request->login);

        if (Auth::attempt([$loginField => $request->login, 'password' => $request->password])) {
            return redirect()->route('home'); // or wherever you want to redirect
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function findLoginField($login)
    {
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        } elseif (preg_match('/^[0-9]{10,15}$/', $login)) {
            return 'phone';
        } else {
            return 'username';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
