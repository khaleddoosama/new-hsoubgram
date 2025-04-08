<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostLiked extends Notification
{
    use Queueable;

    public function __construct(public Post $post, public User $likedBy) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'like',  // like or comment
            'message' => $this->likedBy->name . ' liked your post.', // Use likedBy here instead of user
            'username' => $this->likedBy->username, // Use likedBy here instead of user
            'user_image' => $this->likedBy->image, // Use likedBy here instead of user
            'post_link' => route('show_post', $this->post->slug), 
        ];
    }
}