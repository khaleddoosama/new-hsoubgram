<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Followers extends Component
{
    public $userid;
    protected $user;

    protected $listeners = ['unfollowUser' => 'getCountProperty'];

    public function getCountProperty()
    {
        $this->user = User::find($this->userid);
        return $this->user->follower()->count();
    }
    public function render()
    {
        return view('livewire.followers');
    }
}