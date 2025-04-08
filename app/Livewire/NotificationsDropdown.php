<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationsDropdown extends Component
{
    public $notifications;

    // Listen for events that trigger a refresh of notifications
    protected $listeners = [
        'likeToggled' => 'refreshNotifications',
        'notificationFetched' => 'refreshNotifications'
    ];

    // Refresh notifications when triggered
    public function refreshNotifications()
    {
        if (Auth::check()) {
            // Fetch the latest 5 unread notifications
            $this->notifications = Auth::user()->unreadNotifications()->take(5)->get();
        }
    }

    // Mark the notification as read
    public function markAsReadAndRedirect($notificationId, $url)
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications()
                ->where('id', $notificationId)
                ->update(['read_at' => now()]);
            
            $this->refreshNotifications();
            return redirect()->to($url);
        }
    }

    // Render the component
    public function render()
    {
        // Trigger the notification refresh on page load
        $this->refreshNotifications();

        return view('livewire.notifications-dropdown');
    }
}