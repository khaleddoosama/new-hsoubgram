<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class FollowingModal extends ModalComponent
{
    public $userid;
    protected $user;
    
    public function getFollowingListProperty()
    {    
        $this->user=User::find($this->userid);
        return $this->user->following()->wherePivot('confirmed', true)->get();
    }

    public function unfollow($userid)
    {
        $following_list = User::find($userid);
        Auth::user()->unfollow($following_list);
        $this->dispatch('unfollowuser');
    }

    public function render()
    {
        return view('livewire.following-modal');
    }
}