<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Followprofile extends Component
{

    public $user;
    public $isFollowing;
    public $isPending;

    public function mount($user)
    {
        $this->user = $user;
        $this->updateFollowStatus();
    }

    public function toggle_follow()
    {
        $user = Auth::user();

        if ($this->isFollowing) {
            
            $user->unfollow($this->user);
        } elseif (! $this->isPending) {

            $user->follow($this->user);
            $this->dispatch('toggleFollow');  

        }
        // Refresh state after action
        $this->updateFollowStatus();

    }

    public function updateFollowStatus()
    {   if(Auth::user())
        {
        $this->isFollowing = Auth::user()->isFollowing($this->user);
        $this->isPending   = Auth::user()->is_pending($this->user);
        
        }
    }
    
    public function render()
    {
        return view('livewire.followprofile');
    }
}