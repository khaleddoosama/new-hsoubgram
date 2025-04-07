<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class FollowerModal extends ModalComponent
{
    public $userid;
    protected $user;

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function getFollowersListProperty()
    {
        $this->user = User::find($this->userid);
        return $this->user->follower()->get();
    }

    public function removeFollower($userid)
    {
        $follower = User::find($userid);
        $this->user = User::find($this->userid);
        $follower->unfollow($this->user);
        $this->dispatch('unfollowUser');

    }
    public function render()
    {
        return view('livewire.follower-modal');
    }
}