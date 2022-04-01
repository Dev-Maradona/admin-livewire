<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Users extends Component
{
    // Traits
    use WithPagination;
    use WithFileUploads;

    public $editForm = false;
    public $createForm = false;
    public $deleteModal = false;

    // Values
    public $image, $name, $email, $password, $rpassword, $status;

    // Current userid for update
    public $currentUserId;

    // Search input
    public $search = null;

    public function openEditForm($id) {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $this->name = $user->name;
                $this->email = $user->email;
                $this->password = '';
                $this->rpassword = '';
                $this->status = $user->status;
                $this->currentUserId = $user->id;
                $this->editForm = true;
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'No user with this ID'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'You must type userID to find his values'
            ]);
        }
    }

    public function openCreateForm() {
        // Reset Values
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->rpassword = '';
        $this->status = '';
        // Open form
        $this->createForm = true;
    }

    public function openDeleteModal() {
        $this->deleteModal = true;
    }

    public function resetForms() {
        $this->editForm = false;
        $this->createForm = false;
    }

    public function resetModals() {
        $this->deleteModal = false;
    }

    // Validation
    public function updated() {

        if ($this->editForm) {
            // If you in edit form
            $this->validate([
                'name'  =>  'required|min:6|max:16',
                'email'  =>  'required|min:6|max:32',
                'password'  =>  'min:6|max:32',
                'rpassword'  =>  'min:6|max:32|same:password',
                'status'    =>  'required'
            ]);

        } else {
            // If you in create form
            $this->validate([
                'name'  =>  'required|min:6|max:16',
                'email'  =>  'required|min:6|max:32|unique:users',
                'password'  =>  'required|min:6|max:32',
                'rpassword'  =>  'required|min:6|max:32|same:password',
                'status'    =>  'required'
            ]);
        }
    }

    // DB Methods
    public function createUser() {

        // Validation
        $this->validate([
            'name'  =>  'required|min:6|max:16',
            'email'  =>  'required|min:6|max:32|unique:users',
            'password'  =>  'required|min:6|max:32',
            'rpassword'  =>  'required|min:6|max:32|same:password',
            'status'    =>  'required',
            'image' =>  'required|image|max:512',
        ]);

        $fileName = $this->image->store('users/image', 'public');

        // Create new user
        $newUser = User::create([
            'name'  =>  $this->name,
            'email' =>  $this->email,
            'password'  =>  Hash::make($this->password),
            'image_path'    =>  $fileName,
            'status'    =>  $this->status
        ]);

        if ($newUser) {
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'User is created successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'Something went wrong please try again later'
            ]);
        }
    }

    public function updateUser() {
        $user = User::find($this->currentUserId);
        if ($user) {
            
            $this->validate([
                'name'  =>  'required|min:6|max:16',
                'email'  =>  'required|min:6|max:32',
                'password'  =>  'min:6|max:32',
                'rpassword'  =>  'min:6|max:32|same:password',
                'status'    =>  'required',
            ]);

            $updateUser = $user->update([
                'name'  =>  $this->name,
                'email' =>  $this->email,
                'password'  =>  Hash::make($this->password),
                'status'    => $this->status
            ]);

            if ($updateUser) {
                $this->dispatchBrowserEvent('toastr:success', [
                    'message'   =>  'User is updated successfuly'
                ]);
                $this->mount();
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'Something went wrong please try again later'
                ]);
            }
        }
    }

    public function deleteUser($id) {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'User is deleted successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'No user with this ID'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.users', [
            'users' =>  User::where('name', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%'.$this->search.'%')->paginate(10),
        ])->extends('layouts.admin.app');
    }
}