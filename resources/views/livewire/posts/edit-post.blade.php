<section>
     <form method="POST" wire:submit="editpost" class="flex flex-col gap-6">
            <div class="space-y-6">
                <div class="text-left">
                    <flux:heading size="lg">Edit Post</flux:heading>
                    <flux:text class="mt-2">Make It Catchy and Descriptive</flux:text>
                </div>
                <!-- Post Title -->
                    <flux:input
                        wire:model="title"
                        :label="__('Title')"
                        type="text"
                        required
                        autofocus
                        autocomplete="title"
                        :placeholder="__('Post Title')"
                    />

                <!-- Description -->
                    <flux:textarea
                        wire:model="description"
                        rows="5"
                        :label="__('Description')"
                        type="text"
                        autofocus
                        autocomplete="description"
                        :placeholder="__('Description')"
                    />

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </div> 
        </form>
</section>
