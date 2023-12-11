<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class userController extends Controller
{
    
    public  function  login  (Request $r){
      
        $email = $r->input('email');
        $pass = $r->input('password');
        if($email && $pass){
            $users = new User();

            $user = $users->where('email', '=', $email)->first();
            if($user){
                   $pass_verify = password_verify($pass, $user->password);
                   if($pass_verify){
                      $auth =  Auth::loginUsingId($user->id);
                      $res = new Response();
                      $minutes = 60;
                      $res->withCookie(cookie('token',$auth->token , $minutes));
                     
                        return $res;
        
                   }else{
                        return ['error'=>'E-mail e/o senha errados'];
                   }
                   
                }
                
            }

        return ['error'=>'Preencha os todos os campos'];
    }

    public function registe(Request $r){
       
        $name = $r->input('name');
        $email = $r->input('email');
        $pass = $r->input('password');

        

        if($name && $email && $pass){

            $tokenCreate =  Date(now()).rand(0, 9999);
            $token = password_hash($tokenCreate, PASSWORD_BCRYPT);
            $password = password_hash($pass, PASSWORD_BCRYPT);

            $newUser = [
                    'name'=>$name,
                    'email'=>$email,
                    'password' => $password,
                    'token'=>$token
            ];
            
            $users = new User($newUser);
            $users->save();
            $auth =  Auth::loginUsingId($users->id);
           
            return [$auth];
        }

        return ['error'=>'Preencha os todos os campos'];
    }
    
    
    public function users (Request $r){
        $token = $r->cookie('token');
        $users = new User();
        if($token){
            $user = $users->where('token','=', $token)->get();
            return ['user'=>$user];
        }
        return ['user'=>'Token invalido'];
        
        
    }
}
