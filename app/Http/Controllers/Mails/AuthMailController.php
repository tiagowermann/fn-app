<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\EnvielEmail;
use App\Mail\ResgisterEmail;
use App\Models\Balances;
use App\Models\Release;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthMailController extends Controller
{
    //
    public function senRegisterMail(){
        $user = auth()->user();
        $mail = new ResgisterEmail([$user]);
       
        Mail::to($user->email)->send($mail);

        return redirect()->route('home');
    }

    public function senEnvilOnMail(string $slug){
    
       
        $user = auth()->user();
        $mail = new EnvielEmail($slug);
        Mail::to($user->email)->send($mail);

        return redirect()->route('dashboard');
    }
}
