<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(AuthService $authService)
    {
        $this->auth = $authService;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(AuthRequest $request){
        $data = $request->except('name');
        return $this->auth->check_login($data);
    }
    
    public function register(RegisterRequest $request)
    {
        $data = $request->except('password');
        return $this->auth->register($data, $request);
    }

    public function logout(){
        return $this->auth->logout();
    }

    public function profile()
    {
        return $this->auth->profile();
    }

}
