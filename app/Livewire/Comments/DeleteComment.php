<?php

namespace App\Livewire\Comments;

use Livewire\Component;

use Flux\Flux;

use App\Models\Comment;

class DeleteComment extends Component
{
    public $id;

    public $comment = '';

    public $post_title = '';

    public function mount()
    {
        $current_comment = Comment::find($this->id);

        $this->comment = $current_comment->comment;

        $this->post_title = $current_comment->post->title;
    }

    public function deleteComment()
    {
        // dd('Am here!!', $this->id);

        $current_comment = Comment::find($this->id);

        $current_comment->delete();

        $this->id =  '';
        $this->comment = '';
        $this->post_title = '';

        $this->dispatch('comment-deleted', type: 'deleted'); 

        Flux::modals()->close();
    }
}
