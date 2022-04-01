<?php

namespace App\Http\Livewire\Admin\Pages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $name, $email, $password;
    public $credentials = [];

    public function adminLogin() {
        $this->credentials = ['email' => $this->email, 'password' => $this->password];
        if (Auth::guard('admin')->attempt($this->credentials)) {
            redirect()->route('admin.dashboard');
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'Email or password is wrong'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.login')->extends('layouts.admin.app-login');
    }
}