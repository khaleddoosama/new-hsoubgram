    <div class="w-[30rem] mx-auto lg:w-[95rem]">
        @forelse ($this->posts as $p)
        <livewire:post :post="$p" wire:key="post-{{ $p->id }}" />
        @empty

            <div class="max-w-2xl gap-8 mx-auto">
                {{ __('Start Follwing your friends and Enjoy.') }}
            </div>
        @endforelse
    </div> 
