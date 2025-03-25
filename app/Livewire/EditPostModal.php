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
        $this->validate([
            'description' => 'required',
        ]);

        // Retrieve the post again to ensure it's not null
        $post = Post::find($this->postid);

        if (! $post) {
            session()->flash('error', 'Post not found.');
            return;
        }

        $post->update([
            'description' => $this->description,
        ]);

        return redirect()->route('show_post', ['post' => $post->slug]);
    }

    public function render()
    {
        return view('livewire.edit-post-modal');
    }
}