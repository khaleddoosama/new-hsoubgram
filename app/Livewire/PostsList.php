<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostsList extends Component
{
    public $posts = [];

    protected $listeners = [
        'toggleFollow' => 'loadPosts',
        'postCreated' => 'addPostToList',
    ];

    public function mount()
    {
        $this->loadPosts(); // Load posts on initial page load
    }

    public function loadPosts()
    {
        $ids = auth()->user()->following()
            ->wherePivot('confirmed', true)->get()
            ->pluck('id');

        $this->posts = Post::whereIn('user_id', $ids)
            ->latest()
            ->get();
    }

    public function addPostToList($postId)
    {
        $post = Post::find($postId);

        if ($post) {
            $this->posts->prepend($post);
        }
    }

    public function render()
    {
        return view('livewire.posts-list');
    }
}