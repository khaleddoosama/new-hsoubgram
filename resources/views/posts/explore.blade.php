<x-app-layout>

    <div class="grid grid-cols-3 gap-1 md:gap-5 mt-8">
        @foreach($posts as $post)
            <div>
                <a href="/post/{{ $post->slug }}">
                    <img 
                        src="{{ asset('storage/'.$post->image) }}" 
                        class="w-full h-64 object-cover rounded"
                        alt="post image"
                    >
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-5">
        {{ $posts->links() }}
    </div>
</x-app-layout>
