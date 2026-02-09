<?php

namespace App\Livewire\Posts;

use Livewire\Component;

use Flux\Flux;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AddPost extends Component
{
    public string $title = '';

    public string $description = '';
    
    public function addpost(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'max:191'],
        ]);

        $post_user_id = Auth::user()->id;

        // dd($this->title, $this->description);

        $post = Post::create([
            'user_id' => $post_user_id,
            'title' => $this->title,
            'post' => $this->description,
        ]);

        $this->title = '';
        $this->description = '';

        $this->dispatch('post-created', type: 'p_created'); 

        Flux::modal('add-post')->close();
    }
    
    public function render()
    {
        return view('livewire.posts.add-post');
    }
}
