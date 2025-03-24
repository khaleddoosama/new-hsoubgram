<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Following extends Component
{
    public $userid;
    protected $user;

    protected $listeners = ['unfollowuser' => 'getCountProperty'];

    public function getCountProperty()
    {   
        $this->user=User::find($this->userid);
        return $this->user->following()->wherePivot('confirmed', true)->count();
    }
    public function render()
    {
        return view('livewire.following');
    }
}