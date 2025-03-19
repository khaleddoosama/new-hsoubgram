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

                    <img src="{{ Str::startsWith($post->owner->image, 'https') ? $post->owner->image : asset('storage/' . $post->owner->image) }}"
                        alt="{{ $post->owner->username }}" class="mr-5 h-10 w-10 rounded-full">
                    <div class="grow">
                        <a href="/profile" class="font-bold">{{ $post->owner->username }}</a>
                    </div>
                        @if ($post->owner->id == auth()->id())
                        <a href="/post/edit/{{ $post->slug }}"><i class="bx bx-messsage-square-edit text-xl"></i></a>
                        <form action="/p/{{ $post->slug }}/delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are You sure?')">
                                <i class="bx bx-message-square-x ml-2 text-xl text-red-600"></i>
                            </button>
                        </form>
                        @elseif(auth()->user()->isFollowing($post->owner))
                        <form action="{{ route('unfollow', $post->owner) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-30 text-red-400 text-sm font-bold px-3 text-center">
                                {{ __('Unfollow') }}
                            </button>
                        </form>
                        @elseif(auth()->user()->is_pending($post->owner))
                        <span class="w-30 bg-gray-400 text-white px-3 rounded text-center self-start">{{ __('Pending') }}</span> 
                        @else()
                        <form action="{{ route('follow', $post->owner) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-30 text-blue-400 text-sm font-bold px-3 text-center">
                                {{ __('Follow') }}
                            </button>
                        </form> 
                        @endif

                </div>

            </div>



            <div class="grow">
                @foreach ($post->comments as $comment)
                    <div class="flex items-start px-5 py-2">
                        <img class="h-10 mr-5 w-10 rounded-full"
                            src="{{ Str::startsWith($comment->owner->image, 'https') ? $comment->owner->image : asset('storage/' . $comment->owner->image) }}"
                            alt="">
                        <div class="flex flex-col">
                            <div>
                                <a href="{{route('userprofile',$comment->owner->username)  }}"
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

                    @if ($post->liked(Auth::user()->id))
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
