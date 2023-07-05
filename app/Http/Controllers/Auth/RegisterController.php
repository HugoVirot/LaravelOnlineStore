<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationCompleted;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'nom' => ['required', 'string', 'max:30'],
                'prenom' => ['required', 'string', 'max:30'],
                'pseudo' => ['required', 'string', 'max:30'],
                'email' => ['required', 'string', 'email', 'max:40', 'unique:users'],
                'password' => [
                    'required', 'confirmed',
                    Password::min(8) // minimum 8 caractères   
                        ->mixedCase() // Require at least one uppercase and one lowercase letter...
                        ->letters()  // Require at least one letter...
                        ->numbers() // Require at least one number...
                        ->symbols() // Require at least one symbol...       
                ],   // nouvelle syntaxe validation mdp, + d'infos : https://laravel.com/docs/8.x/validation#validating-passwords     
                'politique' => 'required', // on vérifie que la checkbox est cochée
            ],
            ['politique.required' => 'Veuillez cocher la case pour accepter la politique de confidentialité et les mentions légales']
        );  // message d'erreur personnalisé si on ne coche pas la checkbox
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'pseudo' => $data['pseudo'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Mail::to($user->email)->send(new RegistrationCompleted($user));

        return $user;
    }
}
