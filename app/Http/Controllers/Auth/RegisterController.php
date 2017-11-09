<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Entities\InvitedClients;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Auth\Events\Registered;

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

    protected $em;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EntityManagerInterface  $em)
    {
        $this->em = $em;
        $this->middleware('guest');
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public function showRegistrationForm()
    {
        $email = Input::get('email', false);
        return view('auth.register', ['email' => $email]);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $data['roles'] = 'ROLE_USER';
        event(new Registered($user = $this->create($data)));
        if($obj = $this->em->getRepository(InvitedClients::class)->findOneBy(['emailClient' => $data['email'], 'status' => 0])){
            $obj->setStatus(1);
            $this->em->flush();
        }
        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:App\Entities\User',
            'password' => 'required|string|min:6|confirmed',
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
            'name' => $data['name'],
            'email' => $data['email'],
            'roles' => $data['roles'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
