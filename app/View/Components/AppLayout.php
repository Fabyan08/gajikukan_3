<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $user = User::find(auth()->id());
        return view('layouts.dashboard.config',  ['user' => $user]);
    }
}
