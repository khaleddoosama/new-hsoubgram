<?php
namespace App\Livewire;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class EditPostModal extends ModalComponent
{
    public $postid;
    protected $post;
    public $description;

    public function mount($postid)
    {
        $this->postid = $postid;
        $this->post   = Post::find($postid);
        $this->description = $this->post->description;
    }

    public function getPostProperty()
    {
        return $this->post;
    }
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }
    public function update()
    {
        // First, check if the post exists
        $post = Post::find($this->postid);
    
        if (!$post) {
            session()->flash('error', 'Post not found.');
            return redirect()->route('posts.index'); // Redirect to wherever you want to go if the post isn't found
        }
    
        // Manually check if the description is empty
        if (empty($this->description)) {
            $errorMessage = __('description_empty');
            session()->flash('error', $errorMessage);
            return redirect()->route('show_post', ['post' => $post->slug]);
        }
    
        // Update the post with the new description
        $post->update([
            'description' => $this->description,
        ]);
    
        // Redirect to the post's page after updating
        return redirect()->route('show_post', ['post' => $post->slug]);
    }
    
    
    public function render()
    {
        return view('livewire.edit-post-modal');
    }
}