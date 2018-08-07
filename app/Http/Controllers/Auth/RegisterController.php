<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Role;
use App\Entities\User;
use App\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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

    private $em;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->middleware('guest');
        $this->em = $em;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['cpf'] = preg_replace( '/[^0-9]/is ', '', $data['cpf']);
        return Validator::make($data, [
            'name' => 'required|string|max:100',
            'last_name' => 'string|max:100|nullable',
            'email' => 'required|string|email|max:255|unique:App\Entities\User,email',
            'password' => 'required|string|min:6|confirmed',
            'cpf' => 'required|string|unique:App\Entities\User,cpf'
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Entities\User
     */
    protected function create(array $data)
    {
        $role = $this->em->getRepository(Role::class)
            ->find(RoleEnum::PARTICIPANTE);

        $user = new User();
        $user->setNome($data['name']);
        if(isset($data['last_name']))
            $user->setSobrenome($data['last_name']);
        $user->setCpf(preg_replace( '/[^0-9]/is ', '', $data['cpf']));
        $user->setEmail($data['email']);
        $user->setPassword(Hash::make($data['password']));
        $user->setRole($role);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
