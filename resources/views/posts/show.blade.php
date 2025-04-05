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
                <div class="flex items-center p-5 gap-2">

                    <img src="{{ Str::startsWith($post->owner->image, 'https') ? $post->owner->image : asset('storage/' . $post->owner->image) }}"
                        alt="{{ $post->owner->username }}" class="mr-5 h-10 w-10 rounded-full">
                    <div class="grow">
                        <a href="{{ route('userprofile', $post->owner->username) }}"
                            class="font-bold">{{ $post->owner->username }}</a>
                    </div>
                    @can('update', $post)
                        {{-- <a href="{{ route('get_update_post',$post->slug) }}"><i class="bx bx-message-square-edit text-xl"></i>
                        </a> --}}
                        <button
                            onclick="Livewire.dispatch('openModal', { component: 'edit-post-modal' ,arguments:{postid:{{ $post->id }}} })"><i
                                class="bx bx-message-square-edit text-xl"></i></button>
                    @endcan
                    @can('delete', $post)
                        <form id="delete-post-form-{{ $post->id }}" action="{{ route('post.destroy', $post->slug) }}"
                            method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-600" onclick="confirmDelete({{ $post->id }})">
                                <i class="bx bx-message-square-x text-xl"></i>
                            </button>
                        </form>
                    @endcan

                    @cannot('update', $post)
                        <livewire:followbutton :postOwner="$post->owner" />
                    @endcannot
                </div>

            </div>



            <div class="grow">

                <div class="flex items-start px-5 py-2">
                    <img class="ltr:mr-5 rtl:ml-5 h-10 w-10 rounded-full"
                        src="{{ Str::startsWith($post->owner->image, 'https') ? $post->owner->image : asset('storage/' . $post->owner->image) }}"
                        alt="">
                    <div class="flex flex-col">
                        <div>
                            <a href="{{ route('userprofile', $post->owner->username) }}"
                                class="font-bold mr-2 inline-block">{{ $post->owner->username }}</a>
                            <span class="inline">{{ $post->description }}</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">
                            {{ $post->created_at->diffForHumans(null, true, true) }}
                        </div>
                    </div>
                </div>
                




                @foreach ($post->comments as $comment)
                <div class="flex items-start px-5 py-2">
                    <img class="h-10 w-10 rounded-full ltr:mr-5 rtl:ml-5"
                        src="{{ Str::startsWith($comment->owner->image, 'https') ? $comment->owner->image : asset('storage/' . $comment->owner->image) }}"
                        alt="">
                    <div class="flex flex-col">
                        <div>
                            <a href="{{ route('userprofile', $comment->owner->username) }}"
                                class="font-bold mr-2 inline-block">{{ $comment->owner->username }}</a>
                            <span class="inline">{{ $comment->body }}</span>
                        </div>
                        <div class="mt-1 text-sm text-gray-400">
                            {{ $comment->created_at->diffForHumans(null, true, true) }}
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="border-t p-3 flex flex-row">
                <livewire:like :post="$post" />
                <a class="grow" onclick="document.getElementById('comment_body').focus()"><i
                        class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer ltr:mr-3 rtl:ml-3"></i></a>

            </div>
            <livewire:likedby :post="$post" />

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
<script>
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-post-form-' + postId).submit();
            }
        });
    }
</script>
