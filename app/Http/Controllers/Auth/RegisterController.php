<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Offices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $offices = Offices::orderBy('office_name', 'ASC')->get();
        return view('auth.register', compact('offices'));
    }

    /**
     * Validate if username already exist
     *
     */
    public function usernameExist(Request $request)
    {
        $username = User::where('username', $request['username'])->exists();

        if ( $username ) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    /**
     * Validate if email already exist
     *
     */
    public function emailExist(Request $request)
    {
        $email = User::where('email', $request['email'])->exists();

        if ( $email ) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            /*'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',*/
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname'      => $data['firstname'],
            'lastname'       => $data['lastname'],
            'email'          => $data['email'],
            'office_id'      => $data['unit'],
            'position'       => $data['position'],
            'username'       => $data['username'],
            'password'       => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        /*$this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());*/

        return redirect('/login')->with('info', 'Confirm user credentials to the <strong>system administrator</strong> first before using your account.');
    }
}
