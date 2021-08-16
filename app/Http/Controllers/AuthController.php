<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthForgotPasswordRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthResetPasswordRequest;
use App\Http\Requests\AuthVerifyEmailRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private  $authService;
 

    public function __construct(AuthService $authService) 
    {
        $this->authService = $authService;
       
    }

    public function login(AuthLoginRequest $request){

        $input = $request->validated();

       

        $token = $this->authService->login($input['email'], $input['password']);

        return  (new UserResource(auth()->user()))->additional($token);
     
    }

     public function register(AuthRegisterRequest $request){

        $input = $request->validated();


        //como last_name é um camppo opicional, faço a condição se ele exsite ou nao e aí posso fazer em outros campos que sejam nao obrigatórios
        $user = $this->authService->register($input['first_name'],
        $input['last_name'] ?? '', $input['email'], $input['password']);


        return new UserResource($user);

        // $token = $this->authService->login($input['email'], $input['password']);

        // return  (new UserResource(auth()->user()))->additional($token);
     
    }

    public function verifyEmail(AuthVerifyEmailRequest $request){

        $input = $request->validated();

        $user =  $this->authService->verifyEmail($input['token']);

        return new UserResource($user);
    }

    public function forgotPassword(AuthForgotPasswordRequest $request){

        $input = $request->validated();

        $user =  $this->authService->forgotPassword($input['email']);

        return $user;
    }

    public function resetPassword(AuthResetPasswordRequest $request){

       

        $input = $request->validated();

        return $this->authService->resetPassword($input['email'],$input['password'], $input['token'] );

        
    }

   
}
