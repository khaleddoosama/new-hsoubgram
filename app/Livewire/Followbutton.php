<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Followbutton extends Component
{
    public $postOwner;
    public $isFollowing;
    public $isPending;
    public $classes;
    
    public function mount($postOwner)
    {
        $this->postOwner = $postOwner;
        $this->updateFollowStatus();
    }

    public function toggle_follow()
    {
        $user = Auth::user();

        if ($this->isFollowing) {
            // Unfollow the user
            $user->unfollow($this->postOwner);
        } elseif (! $this->isPending) {

            $user->follow($this->postOwner);
            $this->dispatch('toggleFollow');  

        }

        // Refresh state after action
        $this->updateFollowStatus();
    }

    public function updateFollowStatus()
    {
        $this->isFollowing = Auth::user()->isFollowing($this->postOwner);
        $this->isPending   = Auth::user()->is_pending($this->postOwner);
    }

    public function render()
    {
        return view('livewire.followbutton');
    }
}