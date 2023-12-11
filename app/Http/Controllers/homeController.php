<?php

namespace App\Http\Controllers;


use App\Models\Balances;
use App\Models\Release;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class homeController extends Controller
{
    //
    public function singUp(){
        return view('singup');
    }
    public function singUpAction(Request $r){
        $users = new User();

        $name = $r->input('name');
        $email = $r->input('email');
        $password = $r->input('password');
        if($name && $email && $password){
            // $emailVerify = $users->where('email', '=', $email)->get();
            // if($emailVerify){
            //     dd('email ja cadastrado');
            // }
            
            $tokenCreate =  Date(now()).rand(0, 9999);
            $token = password_hash($tokenCreate, PASSWORD_BCRYPT);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $newUser = [
                    'name'=>$name,
                    'email'=>$email,
                    'password' => $password,
                    'token'=>$token
            ];
            
            
            $users = new User($newUser);
            $users->save();

            $newbanl = [
                'entry'=>0,
                'exit'=>0,
                'id_user'=>$users->id
            ];
            $banlances = new Balances($newbanl);
            $banlances->save();

            Auth::loginUsingId($users->id);
            return redirect()->route('home');
        }

        
            
    }

    public function login(){
         return view('login');
    }
    public function loginAction(Request $r){
        $email = $r->input('email');
        $password = $r->input('password');

        $user = User::where('email', '=', $email)->first();
        if(!$user){
            return redirect()->route('login')->withErrors(['error'=>'E-mail e/ou senha estão errados']);
        }
        if(!password_verify($password, $user->password)){
            return redirect()->route('login')->withErrors(['error'=>'E-mail e/ou senha estão errados']);
        }
        $auth = Auth::loginUsingId($user->id);
        $res = new Response();
        $minutes = 60;
        $res->withCookie(cookie('token',$auth->token , $minutes));
      
        return redirect()->route('home');
             
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }


    public function home(){
       
        $token = '';
        if(auth()->user()){
            $token = auth()->user()->token;
            $data['email'] = auth()->user()->email;

        }


       
    $data = [];

    $users = new User();
    $banlances = new Balances();
    $releases = new Release();

    $user = $users->where('token', '=', $token)->first();
    $data['balance'] = '';
    $data['releases'] = [];
    if($user){
        $data['balance'] = $banlances->where('id_user', '=', $user->id)->first();
        $data['releases'] = $releases->where('id_user', '=', $user->id)->orderBy('type', 'DESC')->get();
        

    }
      
        return view('home', $data);
    }

    public function formAction(Request $r){
        $token = '';
        
        if(auth()->user()){
            $token = auth()->user()->token;
        }
        
        $users = new User();
        $banlances = new Balances();
        $description = $r->input('description');
        $value = intval($r->input('valor'));
        $radio = intval($r->input('radio'));
        
        
         if($description && $value){
           
           $user = $users->where('token', '=', $token)->first();
           
            if($user){
                
                $newReleanse = [
                    'description'=>$description,
                    'value'=>$value,
                    'type' => $radio,
                    'id_user'=>$user->id
                    ];
            
                $releases = new Release($newReleanse);
                if($radio == 1 || $radio == '1'){
                   $bal = $banlances->where('id_user', '=', $user->id)->first();
                   
                   $bal->entry = $bal->entry + $value;
                   $bal->save();
                }
                if($radio == 0 || $radio =='0'){
                    $bal = $banlances->where('id_user', '=', $user->id)->first();
                    
                    $bal->exit = $bal->exit + $value;
                    $bal->save();
                }
                $releases->save();
               
                
           }
        }
        return redirect('/');

    }

    public function Edit(Request $r){
        $data = [];
        $id = $r->input('id');
        $desc = $r->input('desc');
        $val = $r->input('val');
        $type = $r->input('type');
        $data = [
            'id'=>$id,
            'desc'=>$desc,
            'val'=>$val,
            'type' =>$type
        ];
        return view('editar', $data);
    }
    public function EditAction(Request $r){
        
        $id = $r->input('id');
        $desc = $r->input('desc');
        $val = $r->input('val');
        $type = $r->input('radio');

        $releases = new Release();
        $banlances = new Balances();
        $users = new User();

        $token = '';
        if(auth()->user()){
            $token = auth()->user()->token;
           
            $user = $users->where('token', '=', $token)->first();
            

            $newReleases = $releases
                                ->where('id_user', '=', $user->id)
                                ->where('id', '=', $id)
                            ->first();
            
           
            $newReleases->description = $desc;
           $p = $newReleases->value = $val;
            $newReleases->type = $type;
            $newReleases->save();

            $typesReleases = $releases
            ->where('id_user', '=', $user->id)
            ->where('type', $type)
        ->get();
        

          
                $bal = $banlances->where('id_user', '=', $user->id)->first();
                $ArrayRel = $typesReleases->toArray();
                $valueTypes = array_column($ArrayRel, 'value');
                
                if($type == 1 || $type == '1'){
                    $releanseExit = $releases ->where('id_user', '=', $user->id)->where('type', 0)->get();
                    $arrayExit = $releanseExit->toArray();
                    $valueExit = array_column($arrayExit, 'value');
                    $entry = array_sum($valueTypes);
                   
                        $bal->entry = $entry;
                        $bal->exit = array_sum($valueExit);
                        $bal->save();
                        return redirect()->route('home');

                        }
                if($type == 0 || $type =='0'){
                    $releanseEntry = $releases ->where('id_user', '=', $user->id)->where('type', 1)->get();
                    $arrayEntry = $releanseEntry->toArray();
                    $valueEntry = array_column($arrayEntry, 'value');
                    $exit = array_sum($valueTypes);

                    $bal->entry = array_sum($valueEntry);
                    $bal->exit = $exit;
                    $bal->save();
                    return redirect()->route('home');
                }
            
                
                return redirect()->route('home');
            


        }

    }
   

    public function deleteFn(Request $r){
        $token = '';
        if(auth()->user()){
            $token = auth()->user()->token;
        }
        $id = $r->input('id');
        $value = $r->input('values');
        $type = $r->input('type');
      
        $users = new User();
        $releases = new Release();
        $banlances = new Balances();
        $user = $users->where('token', '=', $token)->first();

        if($type == 1 || $type == '1'){
            
            $newbal = $banlances->where('id_user', '=', $user->id)->first();
           
            $newbal->entry = $newbal->entry - $value;
            $newbal->save();
         }
         if($type == 0 || $type =='0'){
            $newbal = $banlances->where('id_user', '=', $user->id)->first();
            $newbal->exit = $newbal->exit - $value;
            $newbal->save();
         }
        $p = $releases->where('id_user', '=', $user->id)->where('id', '=', $id)->delete();
        
        return redirect('/');
    }
}
