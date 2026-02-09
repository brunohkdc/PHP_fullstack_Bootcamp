<?php

namespace App\Livewire\Posts;

use Livewire\Component;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

use Masmerise\Toaster\Toaster;

class AllPosts extends Component
{
    
    public $posts;

    public function mount()
    {
        // Load posts with user and comments relationships
        $this->posts = Post::with(['user', 'comments.user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    public function render()
    {
        return view('livewire.posts.all-posts');
    }

    #[On(['comment-created', 'comment-modified', 'comment-deleted'])]
    public function updatePage($type = NULL) 
    {
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
        
        
        $this->redirectRoute('dashboard');
    }

    public function isMyPost($userId)
    {
        return Auth::id() === $userId;
    }

    public function isMyComment($userId)
    {
        return Auth::id() === $userId;
    }
}
