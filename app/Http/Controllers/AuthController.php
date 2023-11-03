<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Services\UserService;

class AuthController extends Controller
{
	public function login(UserLoginRequest $request)
	{
		return (new UserService())->login($request);
	}

	public function logout()
	{
		(new UserService())->logout();

		return [
			'message' => 'User has been logged out.',
		];
	}
}
