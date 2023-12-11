<?php

namespace App\Http\Controllers;

use App\Models\Release;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class fnController extends Controller
{
    //
    
    public function users (Request $r){
      $token = $r->query('token');
        $users = new User();
        $user = $users->where('token','=', $token)->get();
        return ['user'=>$user];
    }
    public function getFnAllUse(Request $r){
        $array = [];
        $fns = new Release();
        $users = new User();
        $token = $r->cookie('token');
       if($token){
            $user = $users->where('token', '=' , $token)->first();
            $getFn = $fns->where('id_user', '=', $user->id)->get();
            if($getFn){
                return $array['fn'] = $getFn;
            }
       }
        
        return $array;
    }
}
