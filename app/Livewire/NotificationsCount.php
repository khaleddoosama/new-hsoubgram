<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsCount extends Component
{
    public $unreadCount;

    public function render()
    {
        if (Auth::check()) {
            $this->unreadCount = Auth::user()->unreadNotifications()->whereNull('read_at')->count();
        } else {
            $this->unreadCount = 0; // If user is not authenticated, unread count is 0
        }

        return view('livewire.notifications-count');
    }
}