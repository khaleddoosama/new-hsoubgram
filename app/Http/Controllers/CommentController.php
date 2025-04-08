<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\PostCommented;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|string|min:1|max:500',
        ]);

        $comment = $post->comments()->create([
            'body' => $data['body'],
            'user_id' => Auth::id(),
        ]);

        // Notify post owner if it's not their own comment
        if ($post->user_id != Auth::id()) {
            $post->owner->notify(new PostCommented($post, Auth::user()));
        }
        // Dispatch Livewire event
        // $this->dispatchLivewireEvent($post);
        return back()->with('success', 'Comment added successfully!');
    }

    // protected function dispatchLivewireEvent(Post $post)
    // {
    //     // Dispatch browser event that Livewire can listen to
    //     // This works for both Livewire components and regular JS
    //     event(new \App\Events\CommentAdded($post->fresh()->load('comments')));
        
    //     // Alternative: Direct Livewire event dispatch
    //     // This only works if you know the specific Livewire component to target
    //     \Livewire::dispatch('commentAdded', ['post_id' => $post->id]);
    // }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}