<?php

namespace App\Livewire\Posts;

use Livewire\Component;

use Flux\Flux;

use App\Models\Post;


class EditPost extends Component
{

    public $id;

    public string $title = '';

    public string $description = '';

    public function mount()
    {
        $current_post = Post::find($this->id);

        $this->title = $current_post->title;
        $this->description = $current_post->post;
    }
    
    
    public function render()
    {        
        return view('livewire.posts.edit-post');
    }

    public function editpost(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'max:191'],
        ]);
        
        //dd($this->title, $this->description, $this->id);

        $current_post = Post::find($this->id);

        $current_post->title = $this->title;
        $current_post->post = $this->description;

        $current_post->save();

        $this->title = '';
        $this->description = '';
        $this->id = NULL; 

        $this->dispatch('post-modified', type: 'p_modified'); 

        Flux::modals()->close();

    }
}
