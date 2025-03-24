<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class PendingFollowersList extends Component
{
    protected $follower;
    

    protected $listeners=['toggle_follow'=>'$refresh','reqConfirmed' =>'$refresh' ,'reqDeleted'=>'$refresh'];

    public function confirm($id)
    {
        $this->follower=User::find($id);
        auth()->user()->confirm($this->follower);
        $this->dispatch('reqConfirmed');
    }
    public function delete($id)
    {
        $this->follower=User::find($id);
        auth()->user()->deleteFollowReq($this->follower);
        $this->dispatch('reqDeleted');
    }
    
    public function render()
    {
        return view('livewire.pending-followers-list');
    }
}