<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use Livewire\Attributes\Session;
use Livewire\Attributes\On;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Masmerise\Toaster\Toaster;

class ShowComments extends Component
{
    /*#[Session(key: 'componentName')] 
    public $myComponent; */
    
    public $comments;

    public function mount()
    {
        // Load comments with user and posts relationships
        $this->comments = Comment::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()->unique('post_id');

        // $this->myComponent = 'ShowComments';
    }
    
    
    public function render()
    {
        return view('livewire.comments.show-comments');
    }

    #[On(['comment-created', 'comment-modified', 'comment-deleted'])] 
    public function updateComment($type = NULL) 
    {

        // dd('I am in show comment');
        
        $messages = [
            'created' => ['message' => 'Comment created successfully!', 'type' => 'success'],
            'modified' => ['message' => 'Comment updated successfully!', 'type' => 'info'],
            'deleted' => ['message' => 'Comment deleted successfully!', 'type' => 'warning'],
        ];

        if (array_key_exists($type, $messages)) {
            $message = $messages[$type]['message'];
            match($messages[$type]['type']) {
                'success' => Toaster::success($message),
                'info' => Toaster::info($message),
                'warning' => Toaster::warning($message),
            };
        }

        $this->redirectRoute('showcomments');
    } 

    public function isMyComment($userId)
    {
        return Auth::id() === $userId;
    }

    public function isMyPost($userId)
    {
        return Auth::id() === $userId;
    }
}
