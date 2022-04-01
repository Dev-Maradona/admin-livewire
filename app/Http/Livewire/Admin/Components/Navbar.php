<?php

namespace App\Http\Livewire\Admin\Components;

use App\Models\AdminMessage;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $notifications = [];
    public $messages = [];

    public function mount() {
        $notifications = AdminNotification::where(['status' =>  'NotSeen'])->limit(4)->latest('id')->get();
        $this->notifications = $notifications;
        $messages = AdminMessage::where(['status'   =>  'NotSeen'])->limit(4)->latest('id')->get();
        $this->messages = $messages;
    }

    public function countOfNotSeenNotifi() {
        $notifications = AdminNotification::where(['status' =>  'NotSeen'])->count();
        return $notifications;
    }

    public function countOfNotSeenMsgs() {
        $messages = AdminMessage::where(['status'   =>  'NotSeen'])->count();
        return $messages;
    }

    public function adminLogout() {
        Auth::guard('admin')->logout();
        redirect()->route('admin.login');
    }
}