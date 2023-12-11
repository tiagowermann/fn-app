<?php

namespace App\Http\Controllers;

use App\Models\Balances;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {  
       
        $data = [];
        $user = auth()->user();
        if(!$user){
            return redirect()->route('login');
        }
    
        $balances = new Balances();
        $data['balance'] = $balances->where('id_user', '=', $user->id)->first();
        $data['user'] = $user;
        
        return view('painel.home', $data);
    }
    public function store(Request $r){
        $id = auth()->user()->id;
        $name = $r->input('name');
        $email = $r->input('email');
        $users = new User();
        if($name && $email){
            $user =  $users->where('id', '=', $id)->first();
            $user->name = $name;
            $user->email = $email;
            $user->save();

            
        } 
        return redirect()->route('dashboard');
    }
}
