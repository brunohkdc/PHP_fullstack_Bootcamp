<section>
     <form method="POST" wire:submit="deleteComment" class="flex flex-col gap-6">
            <div class="space-y-6">
                <div class="text-center ">
                    <p class="text-2xl text-red-500 font-bold">Are You Sure ?</p>
                </div>
                <div class="text-left">
                    <p class="text-base">To delete this comment:</p>
                    
                    <flux:textarea
                        wire:model="comment"
                        disabled
                    />
                    
                    <p class="text-base mt-6">From this post</p>
                    <p class="text-base mt-2">&quot;{{ $post_title }}&quot;</p>
                    
                </div>

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="danger">Delete</flux:button>
                </div>
            </div> 
        </form>
</section>