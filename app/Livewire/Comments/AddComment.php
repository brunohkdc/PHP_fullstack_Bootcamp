<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use Livewire\Attributes\Session;

use Flux\Flux;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class AddComment extends Component
{
    
    public $comment = '';

    public $post_id;
    
    public function addcomment(): void
    {
        $validated = $this->validate([
            'comment' => ['required'],
        ]);
        
        // $session_value = session()->get('componentName');
        // dd($value);

        $comment_user_id = Auth::user()->id;

        $comment = Comment::create([
            'user_id' => $comment_user_id,
            'post_id' => $this->post_id,
            'comment' => $this->comment,
        ]);

        $this->comment = '';

        /*if ( $session_value === "ShowComments") 
        {
            $this->dispatch('sc-comment-created'); 
            session()->put('componentName', '');
        }*/

        $this->dispatch('comment-created', type: 'created'); 

        Flux::modals()->close();
    }
    
    public function render()
    {
        return view('livewire.comments.add-comment');
    }
}
