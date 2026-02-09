<section>
     <form method="POST" wire:submit="addcomment" class="flex flex-col gap-6">
            <div class="space-y-6">
                <div class="text-left">
                    <flux:heading size="lg">Add Comment</flux:heading>
                    <flux:text class="mt-2">Give me a good comment!!</flux:text>
                </div>

                <!-- Comment -->
                    <flux:textarea
                        wire:model="comment"
                        rows="5"
                        :label="__('Comment')"
                        type="text"
                        required
                        autofocus
                        autocomplete="comment"
                        :placeholder="__('Comment')"
                    />

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </div> 
        </form>
</section>
