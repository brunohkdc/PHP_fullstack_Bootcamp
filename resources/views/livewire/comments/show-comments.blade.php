 <section class="w-full">
    <x-toaster-hub />
    <div class="relative mb-6 w-full">
        <div class="flex justify-between">
            <flux:heading class="mb-6" size="xl" level="1">{{ __('My Commented Posts') }}</flux:heading>
        </div>
        <flux:separator class="border-1" />
    </div>

    <div class="mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
             @if($comments->count() > 0)  
                @foreach ($comments as $comment)                  
                    <div class="relative rounded-xl p-3 border border-neutral-200 dark:border-neutral-700 bg-gray-50" >
                        <div class="col-span-4 text-xl font-semibold text-gray-900">
                            <h2>{{ $comment->post->title }}</h2>
                        </div>
                        
                        <p class="text-sm" style="font-style: italic;">
                            by {{ $comment->post->user->name }}

                                @if( $this->isMyPost($comment->post->user_id))
                                    (your post!!)
                                @endif
                        </p>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-base leading-relaxed">
                                {{ $comment->post->post }}
                        </p>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
                            <div class="mt-6 text-black text-base leading-relaxed">
                                    Comments
                            </div>
                            <div class="mt-6 text-right text-black text-base leading-relaxed">
                                
                                <flux:modal.trigger :name="'add-comment-'.$comment->post->id">
                                    <a class="text-sm underline cursor-pointer">Add Comment</a>
                                </flux:modal.trigger>

                                <flux:modal :name="'add-comment-'.$comment->post->id"  class="md:w-150">
                                    <livewire:comments.add-comment :post_id="$comment->post->id" />
                                </flux:modal>

                            </div>
                        </div>
                            
                        @foreach ($comment->post->comments as $comment)
                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-base leading-relaxed">
                                {{ $comment->comment }}
                            </p>
                            
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
                                <div class="text-sm text-gray-500 dark:text-gray-400" style="font-style: italic;">
                                    by {{ $comment->user->name}}

                                    @if ($this->isMyComment($comment->user_id))
                                        (your comment!!)
                                    @endif

                                </div>
                                <div class="text-right text-black">
                                    @if (Auth::user()->id  == $comment->user_id)
                                        
                                        <flux:modal.trigger :name="'edit-comment-'.$comment->id" >
                                            <a class="text-sm underline cursor-pointer">Edit</a>
                                        </flux:modal.trigger>


                                        <flux:modal :name="'edit-comment-'.$comment->id"  class="md:w-150">
                                            <livewire:comments.edit-comment :id="$comment->id" />
                                        </flux:modal>
                                    
                                        <flux:modal.trigger :name="'del-comment-'.$comment->id" >
                                            <a class="text-sm underline text-red-500 cursor-pointer">Delete!</a>
                                        </flux:modal.trigger>

                                        <flux:modal :name="'del-comment-'.$comment->id"  class="md:w-150">
                                            <livewire:comments.delete-comment :id="$comment->id" />
                                        </flux:modal>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>                                

                @endforeach 
            @endif
        </div>
    </div>
 </section>
