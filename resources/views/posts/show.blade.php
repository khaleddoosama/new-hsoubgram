<x-app-layout>

    <div class="h-screen md:flex md:flex-row">

        {{-- Left Side --}}
        <div class="h-full md:w-7/12 bg-black flex items-center">
            <img alt="{{ $post->description }}" src="{{ asset('storage/' . $post->image) }}"
                class="max-h-screen object-cover mx-auto">
        
            </div>
        
        {{-- Right Side --}}
        <div class="flex w-full flex-col bg-white md:w-5/12">

            {{-- Top Side --}}
            <div class="border-b-2">
                <div class="flex items-center p-5">

                    <img src="{{ Str::startsWith($post->owner->image, 'https') ? $post->owner->image : asset('storage/' . $post->owner->image) }}"  alt="{{ $post->owner->username }}"
                        class="mr-5 h-10 w-10 rounded-full">
                    <a href="/profile" class="font-bold">{{ $post->owner->username }}</a>
                </div>
            </div>



            <div class="grow">
                @foreach ($post->comments as $comment)
                    <div class="flex items-start px-5 py-2">
                        <img class="h-10 mr-5 w-10 rounded-full" src="{{ Str::startsWith($comment->owner->image, 'https') ? $comment->owner->image : asset('storage/' . $comment->owner->image) }}" alt="" >
                        <div class="flex flex-col">
                            <div>
                                <a href="/{{ $comment->owner->username }}"
                                    class="font-bold">{{ $comment->owner->username }}</a>
                                {{ $comment->body }}

                            </div>
                            <div class="mt-1 text-sm font-bold text-gray-400">
                                {{ $comment->created_at->diffForHumans(null, true, true) }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="p-3">
                <a href="{{ route('post.like', $post->slug) }}">
        
                    @if($post->liked(Auth::user()->id))
        
                    <li class="bx bxs-heart text-red-600 text-3xl hover:text-gray-400 cursor-pointer mr-3">
        
                    @else
        
                    <li class="bx bx-heart text-3xl hover:text-gray-400 cursor-pointer mr-3">
        
                    @endif  
                    </li>
                </a>
               
            </div>
            
            <div class="border-t p-5">
                <form action="/post/{{ $post->slug }}/comment" method="POST">
                    @csrf
                    <div class="flex flex-row">
                        <textarea name="body" id="comment_body" placeholder="{{ __('Add a comment...') }}"
                            class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                        <button type="submit"
                            class="ltr:ml-5 rtl:mr-5 border-none bg-white text-blue-500">{{ __('Comment') }}</button>
                    </div>
                </form>
            </div>
            
        </div>



        

    </div>




    </div>



</x-app-layout>
