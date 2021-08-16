<?php

namespace App\Services;

use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\ResetPasswordTokenInvalidException;
use App\Exceptions\UserHasBeenTakerException;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\PasswordReset;
use App\User;
use Illuminate\Support\Str;

class AuthService {
	 public function login(string $email, string $password){

		$login = [
			'email' => $email,
			'password' => $password,

		];

		if(!$token = auth()->attempt($login)) {
			
			throw new LoginInvalidException();


		}

		return [
			'access_token' => $token,
			'token_type' => 'Bearer'
		];

      return response()->json(['msg' => 'login']);
    }


	public function register(string $first_name, string $last_name, string $email, $password) {

		$user = User::where('email', $email)->exists();
		if(!empty($user))  {
			throw new UserHasBeenTakerException();

		}

		$userPassword = bcrypt($password ?? Str::random(10));

		

		 $user = User::create([
            'first_name'         => $first_name,
            'last_name'          => $last_name,
            'email'              => $email,
            'password'           => $userPassword,
            'confirmation_token' => Str::random(60)
        ]);

		event(new UserRegistered($user));

		return $user;
	}

	public function verifyEmail(string $token){
		$user = User::where('confirmation_token', $token)->first();

		if(empty($user)) {

			throw new VerifyEmailTokenInvalidException(); 
		}

		$user->confirmation_token = null;
		$user->email_verified_at = now();
		$user->save();

		return $user;
	}


	public function forgotPassword(string $email){
		
		$user =  User::where('email', $email)->firstOrFail();

		$token = Str::random(60);

		//recurso do laravel que aceita somente o email e um token 
		PasswordReset::create([
			'email' => $user->email,
			'token' => $token,
			
		]);

		event(new ForgotPassword($user, $token));

		return '';
	}

	public function resetPassword(string $email, string $password, string $token){

		$passReset =  PasswordReset::where('email', $email)->where('token', $token)->first();

		if(empty($passReset)) {
			throw new ResetPasswordTokenInvalidException();
		}

		$user = User::where('email', $email)->firstOrFail();
		$user->password = bcrypt($password);
		$user->save();

		PasswordReset::where('email', $email)->delete();
	



		return '';

	}
}