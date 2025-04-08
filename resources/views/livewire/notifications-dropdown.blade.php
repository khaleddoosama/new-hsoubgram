<div wire:poll.2s class="relative">
    <div class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-100">
            <h3 class="text-sm font-medium text-gray-900">{{__('Notifications')}}</h3>
        </div>
        
        <!-- Notifications List -->
        <div class="max-h-80 overflow-y-auto">
            <ul class="divide-y divide-gray-100">
                @forelse($notifications as $notification)
                    <li class="p-3 hover:bg-gray-50" wire:key="notification-{{ $notification->id }}">
                        <a href="#" 
                        class="flex items-start" 
                        wire:click="markAsReadAndRedirect('{{ $notification->id }}', '{{ $notification->data['post_link'] ?? '#' }}')">
                            
                            <!-- Profile Image -->
                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center">
                                <img src="{{ $notification->data['user_image'] ?? asset('default-profile.png') }}" 
                                     class="h-8 w-8 rounded-full object-cover">
                            </div>
                            
                            <!-- Message -->
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-medium">{{ $notification->data['username'] ?? 'User' }}</span>
                                    <span class="text-gray-600">{{ $notification->data['message'] ?? 'liked your post' }}</span>
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-4 py-6 text-center">
                        <p class="text-sm text-gray-500">{{ __('No new notifications') }}</p>
                    </li>
                @endforelse
            </ul>
        </div>

        
    </div>
</div>
