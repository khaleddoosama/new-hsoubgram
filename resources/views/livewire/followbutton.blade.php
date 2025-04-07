<div class="flex space-x-3 items-center">
    @if ($isFollowing)
        <a wire:click="toggle_follow" class="w-auto text-red-400 text-sm font-bold px-3 text-center cursor-pointer whitespace-nowrap">
            {{ __('Unfollow') }}
        </a>
    @elseif($isPending)
        <span class="w-auto bg-gray-400 text-white px-3 rounded text-center self-start whitespace-nowrap">
            {{ __('Pending') }}
        </span>
    @else
        <a wire:click="toggle_follow" class="w-auto text-blue-400 text-sm font-bold px-3 text-center cursor-pointer whitespace-nowrap">
            {{ __('Follow') }}
        </a>
    @endif
</div>

