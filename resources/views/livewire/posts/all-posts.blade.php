<section class="w-full">
    <x-toaster-hub />
    <div class="relative mb-6 w-full">
        <flux:heading class="mb-6" size="xl" level="1">{{ __('All Posts') }}</flux:heading>
        <flux:separator class="border-1" />
    </div>

    <div class="mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            @if($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="relative rounded-xl p-3 border border-neutral-200 dark:border-neutral-700 bg-gray-50" >
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-900">{{ $post->title }}</h2>
                        <p class="text-sm" style="font-style: italic;">
                            by {{ $post->user->name }}

                                @if( $this->isMyPost($post->user_id))
                                    (your post!!)
                                @endif
                        </p>
                        <p class="mt-4 text-gray-500 dark:text-gray-500 text-base leading-relaxed">
                                    {{ $post->post }}
                        </p>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
                            <div class="mt-6 text-black text-base leading-relaxed">
                                Comments
                            </div>
                            <div class="mt-6 text-right text-black text-base leading-relaxed">
                                    
                                <flux:modal.trigger :name="'add-comment-'.$post->id">
                                    <a class="text-sm underline cursor-pointer">Add Comment</a>
                                </flux:modal.trigger>

                                <flux:modal :name="'add-comment-'.$post->id"  class="md:w-150">
                                    <livewire:comments.add-comment :post_id="$post->id" />
                                </flux:modal>

                            </div>
                        </div>
                                
                        @foreach ($post->comments as $comment)
                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-base leading-relaxed">
                                {{ $comment->comment }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400" style="font-style: italic;">
                                by {{ $comment->user->name}}

                                    @if ($this->isMyComment($comment->user_id))
                                        (your comment!!)
                                    @endif

                            </p>
                            <div class="text-right text-black">

                                @if ($this->isMyComment($comment->user_id))
                                    
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
                                    
                        @endforeach


                    </div>
                 @endforeach
            @endif            
        </div>
    </div>
</section>
