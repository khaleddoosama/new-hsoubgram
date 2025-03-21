<x-app-layout>
    <div class="card p-10">
        {{-- Title --}}
        <h1 class="text-3xl mb-10">{{ __('Edit Post') }}</h1>

        {{-- Errors --}}
        <div class="flex flex-col justify-center items-center w-full">
            @if($errors->any())
                <div class="w-full bg-red-50 text-red-700 p-5 mb-5 rounded-xl">
                    <ul class="listed-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Edit Form --}}
        <form action="{{ route('post.update',$post->slug) }}" method="post" class="w-full" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Use PUT method for updates --}}
            
            {{-- Display Old Image --}}
            @if($post->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $post->image) }}" class="w-32 h-32 object-cover rounded-xl" alt="Old Image">
                </div>
            @endif

            {{-- Image Input --}}
            <input name='image' id="file_input" type="file" class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl">
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or GIF</p>

            {{-- Description Input --}}
            <textarea name="description" rows="5" class="mt-10 w-full border border-gray-200 rounded-xl"
            placeholder="{{ __('Write a description...') }}">{{ old('description', $post->description) }}</textarea>
            
            {{-- Submit Button --}}
            <x-primary-button class="mt-4">{{ __('Update Post') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
