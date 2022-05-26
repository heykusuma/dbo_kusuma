<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\ResponseAPI;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService {

    use ResponseAPI;

    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function check_login($data)
    {
		$myTTL = 24 * 60;
		JWTAuth::factory()->setTTL($myTTL);

		if (!$token = JWTAuth::attempt($data)) {
			return $this->errorLogin();
		}

		$token_validity = JWTAuth::factory()->getTTL() * 60;

		return $this->resToken($token, $token_validity);
    }

	public function register(array $data, $request)
    {
        $data['password'] = bcrypt($request->password);
        
        try {
            $this->user->insert($data);
            return $this->successInsert();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function logout()
    {
        Auth()->logout();
        return response()->json(['message' => 'User berhasil logout']);
    }

    public function profile()
    {
        return response()->json(JWTAuth::user());
    }

}

