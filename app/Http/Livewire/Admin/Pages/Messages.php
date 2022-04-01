<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\AdminMessage;
use Livewire\Component;

class Messages extends Component
{

    public $messages = [];

    public function mount() {
        $messages = AdminMessage::get();
        $this->messages = $messages;
    }

    public function clearAllMessages() {
        AdminMessage::truncate();
        $this->dispatchBrowserEvent('toastr:success', [
            'message'   =>  'All Messages has been Cleared'
        ]);
        $this->mount();
    }

    public function clearMessage($id) {
        $message = AdminMessage::find($id);
        $message->delete();
        $this->dispatchBrowserEvent('toastr:success', [
            'message'   =>  'Message Cleared'
        ]);
        $this->mount();
    }

    public function markAsRead($id) {
        $message = AdminMessage::find($id);
        $updateMessage = $message->update([
            'status'    =>  'Seen',
        ]);
        if ($updateMessage) {
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Message Marked as read'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Theres something went wrong please try again later'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.messages')->extends('layouts.admin.app');
    }
}
