<?php

namespace App\Livewire;

use Livewire\Component;

class PendingFollowersCount extends Component
{


    protected $listeners=['toggleFollow'=>'$refresh','reqConfirmed' =>'$refresh' ,'reqDeleted'=>'$refresh'];
    
    public function getCountProperty(){
        return auth()->user()->pending_followers()->count();
    }
    public function render()
    {
        return view('livewire.pending-followers-count');
    }
}