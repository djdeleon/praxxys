<?php

namespace App\Services;

use App\Models\User;

class UserService 
{
  public function login($request)
	{
		$login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) 
			? 'email' 
			: 'username';

		$request->merge([$login_type => $request->input('login')]);

		if (!auth()->attempt($request->only($login_type, 'password'), $request->get('remember'))) {
			return response([
				'error' => 'The provided credentials are not correct.'
			], 422);
		}

		$user = auth()->user();

		if (!$user->is_admin) {
			return response([
				'error' => 'You are not allowed to login using your email.'
			], 422);
		}

		$token = $user->createToken('main')->plainTextToken;

		return response([
			'user' => $user,
			'token' => $token,
		], 201);
	}

  public function logout(): User
	{
		$user = auth()->user();

		$user->currentAccessToken()->delete();

		return $user;
	}
}
