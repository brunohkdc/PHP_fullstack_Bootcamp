<?php

namespace App\Livewire\Comments;

use Livewire\Component;

use App\Models\Comment;

use Flux\Flux;

class EditComment extends Component
{
    public $id;

    public string $comment = '';

    public function mount()
    {
        $current_comment = Comment::find($this->id);

        $this->comment = $current_comment->comment;
    }

    public function render()
    {
        return view('livewire.comments.edit-comment');
    }

    public function updatecomment(): void
    {
        $validated = $this->validate([
            'comment' => ['required'],
        ]);
        
        $current_comment = Comment::find($this->id);

        $current_comment->comment = $this->comment;

        $current_comment->save();

        $this->comment = '';

        $this->dispatch('comment-modified', type: 'modified'); 

        Flux::modals()->close();
    }
}
