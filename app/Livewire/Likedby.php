<?php

namespace App\Livewire;

use Livewire\Component;

class Likedby extends Component
{

    public $post;
    
    protected $listeners = ['likeToggled' => 'getLikesProperty'];
    
    public function getFirstusernameProperty()
    {
        return $this->post->likes()->first()->username;
    }
    public function getLikesProperty()
    {
        return $this->post->likes()->count();
    }
    public function render()
    {
        return view('livewire.likedby');
    }
}