<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{

    public $name, $email, $oldPassword = null, $newPassword = null;

    public $changeInformationsForm = false;

    public function openInformationForm() {

        $admin = Admin::find(Auth::guard('admin')->user()->id);

        if ($admin) {
            $this->name = $admin->name;
            $this->email = $admin->email;
            $this->oldPassword = null;
            $this->newPassword = null;
        }

        $this->changeInformationsForm = true;
    }

    public function closeInformationForm() {
        $this->changeInformationsForm = false;
    }

    public function saveChanges() {

        if ($this->oldPassword !== null) {
            $this->validate([
                'name'  =>  'required|min:6|max:64',
                'email' =>  'required|min:6|max:64',
                'oldPassword'   =>  'required',
                'newPassword'   =>  'required|min:6|max:64'
            ]);

            $admin = Admin::find(Auth::guard('admin')->user()->id);

            if (Hash::check($this->oldPassword, Auth::guard('admin')->user()->password)) {
                $admin->update([
                    'name'  =>  $this->name,
                    'email' =>  $this->email,
                    'password'  =>  Hash::make($this->newPassword),
                ]);
                $this->dispatchBrowserEvent('toastr:success', [
                    'message'   =>  'Informations has been changed'
                ]);
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'Old password is wrong'
                ]);
            }
        
        } else {

            $this->validate([
                'name'  =>  'required|min:6|max:64',
                'email' =>  'required|min:6|max:64',
            ]);

            $admin = Admin::find(Auth::guard('admin')->user()->id);

            $admin->update([
                'name'  =>  $this->name,
                'email' =>  $this->email,
            ]);

            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Informations has been changed'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.profile')->extends('layouts.admin.app');
    }
}
