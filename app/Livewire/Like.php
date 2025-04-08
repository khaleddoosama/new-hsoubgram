<?php

namespace App\Livewire;

use Livewire\Component;
use App\Notifications\PostLiked;

class Like extends Component
{   
    public $post;

    public function mount()
    {
        $this->post->loadMissing('owner');
    }

    public function toggle_like()
    {
        $result = auth()->user()->likes()->toggle($this->post);

        // Notify only when a new like is added
        if (!empty($result['attached']) && $this->post->owner && $this->post->owner->id !== auth()->id()) {
            $this->post->owner->notify(new PostLiked($this->post, auth()->user()));
        }

        $this->dispatch('likeToggled');
    }

    public function render()
    {
        return view('livewire.like');
    }
}