<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\AdminNotification;

use Livewire\Component;
// use Livewire\WithPagination;

class Notifications extends Component
{

    // use WithPagination;

    // Properties 
    public $notifications = [];

    public $search = null;

    public function mount() {
        $notifications = AdminNotification::limit(4)->latest('id')->get();
        $this->notifications = $notifications;
    }

    public function clearAllNotifications() {
        AdminNotification::truncate();
        $this->dispatchBrowserEvent('toastr:success', [
            'message'   =>  'All Notifications has been Cleared'
        ]);
        $this->mount();
    }

    public function clearNotification($id) {
        $notification = AdminNotification::find($id);
        $notification->delete();
        $this->dispatchBrowserEvent('toastr:success', [
            'message'   =>  'Notification Cleared'
        ]);
        $this->mount();
    }

    public function markAsRead($id) {
        $notification = AdminNotification::find($id);
        $notification->update([
            'status'    =>  'Seen'
        ]);
        $this->dispatchBrowserEvent('toastr:success', [
            'message'   =>  'Notification Marked as read'
        ]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.pages.notifications')->extends('layouts.admin.app');
    }
}