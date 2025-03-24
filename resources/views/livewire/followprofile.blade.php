<div>
    @auth
        @if ($user->id === auth()->id())
            <a href="/profile" class="w-50 h-8 border text-sm font-bold py-1 px-1 rounded-md border-neutral-300 text-center cursor-pointer">
                {{ __('Edit Profile') }}
            </a>
        @else
            @if ($isFollowing)
                <a wire:click="toggle_follow" class="w-30 bg-red-500 text-white px-3 py-1 rounded text-center mt-2 cursor-pointer">
                    {{ __('Unfollow') }}
                </a>
            @elseif($isPending)
                <span class="w-30 bg-gray-400 text-white px-3 rounded text-center self-start">{{ __('Pending') }}</span>
            @endauth
            @guest
            @elseif(!$isFollowing && !$isPending)
                 <a wire:click="toggle_follow" class="w-30 bg-blue-400 text-white px-3 py-1 rounded text-center mt-2 cursor-pointer">
                    {{ __('Follow') }}
                </a>
            @endguest
        @endif
    @endif


</div>
