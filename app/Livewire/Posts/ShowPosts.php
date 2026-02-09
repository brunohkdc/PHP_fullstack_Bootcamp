<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\Attributes\On; 
use Flux\Flux;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Masmerise\Toaster\Toaster;

class ShowPosts extends Component
{

    public $posts;

    public function mount()
    {
        // Load posts with user and comments relationships
        $this->posts = Post::where('user_id', Auth::id())
            ->with(['user', 'comments.user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    public function deletepost($id)
    {
        $post = Post::find($id);

        $comments = Comment::where('post_id', $id)->get();

        if (count($comments)) {
            // dd($comments);
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }

        $post->delete();

        Flux::modals()->close();

        $type = 'p_deleted';

        $messages = [
            'p_deleted' => ['message' => 'Post deleted successfully!', 'type' => 'warning']
        ];

        if (array_key_exists($type, $messages)) {
            $message = $messages[$type]['message'];
            match($messages[$type]['type']) {
                'success' => Toaster::success($message),
                'info' => Toaster::info($message),
                'warning' => Toaster::warning($message),
            };
        }

        $this->updatePage();
    }


    public function render()
    {   
        return view('livewire.posts.show-posts');
    }

    
    #[On(['post-created', 'post-modified', 'comment-created', 'comment-modified', 'comment-deleted'])] 
    public function updatePage($type = NULL) 
    {

        // dd('I am in show post');
        
        // Load posts with user and comments relationships
        
        /* $this->posts = Post::where('user_id', Auth::id())
            ->with(['user', 'comments.user'])
            ->orderBy('created_at', 'desc')
            ->get(); */

        /* $this->dispatch('$refresh'); */

        $messages = [
            'created' => ['message' => 'Comment created successfully!', 'type' => 'success'],
            'modified' => ['message' => 'Comment updated successfully!', 'type' => 'info'],
            'deleted' => ['message' => 'Comment deleted successfully!', 'type' => 'warning'],
            'p_created' => ['message' => 'Post created successfully!', 'type' => 'success'],
            'p_modified' => ['message' => 'Post updated successfully!', 'type' => 'info'],
        ];


        if (array_key_exists($type, $messages)) {
            $message = $messages[$type]['message'];
            match($messages[$type]['type']) {
                'success' => Toaster::success($message),
                'info' => Toaster::info($message),
                'warning' => Toaster::warning($message),
            };
        }



        $this->redirectRoute('showposts');
    } 

    public function isMyComment($userId)
    {
        return Auth::id() === $userId;
    }

}
