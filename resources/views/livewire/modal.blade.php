<div x-data="{ open: @entangle('isOpen').defer }">
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
            <button @click="$wire.close()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                &times;
            </button>
            <h2 class="text-xl font-semibold mb-4">{{ __('Modal Title') }}</h2>
            <p class="text-gray-700">{{ __('Modal content goes here.') }}</p>
            <div class="mt-4 flex justify-end">
                <button @click="$wire.close()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    {{ __('Close') }}
                </button>
            </div>
        </div>
    </div>
</div>
