<?php

namespace App\View\Components\base;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {   
        $user = Auth::getUser();
        $data = ['user'=>$user];
        return view('components.base.header',  $data);
    }
}
