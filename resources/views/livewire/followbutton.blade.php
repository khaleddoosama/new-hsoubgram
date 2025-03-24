<div>
    @if ($isFollowing)
        <a wire:click="toggle_follow" class="w-30 text-red-400 text-sm font-bold px-3 text-center cursor-pointer">
            {{ __('Unfollow') }}
        </a>
    @elseif($isPending)
        <span class="w-30 bg-gray-400 text-white px-3 rounded text-center self-start">
            {{ __('Pending') }}
        </span>
    @else
        <a wire:click="toggle_follow" class="w-30 text-blue-400 text-sm font-bold px-3 text-center cursor-pointer">
            {{ __('Follow') }}
        </a>
    @endif
</div>
