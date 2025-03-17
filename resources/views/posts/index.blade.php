<x-app-layout>

    <div class="flex flex-row max-w-3xl gap-8 mx-auto">



        {{-- Left Side --}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse ($post as $p)
                <x-post :post="$p" />
            @empty

                <div class="max-w-2xl gap-8 mx-auto">
                    {{ __('Start Follwing your friends and Enjoy.') }}
                </div>
            @endforelse
        </div>


        {{-- Right Side --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4 ">

            <div class="flex flex-row text-sm">
                <div class="mr-5">
                    <a href="/{{ auth()->user()->username }}">
                        <img src="{{ Str::startsWith(Auth::user()->image, 'https') ? Auth::user()->image : asset('storage/' . Auth::user()->image ) }}"  alt="{{ auth()->user()->username }}"
                            class="border border-gray-300 rounded-full h-12 w-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="/{{ auth()->user()->username }}" class="font-bold">{{ auth()->user()->username }}</a>
                    <div class="text-gray-500 text-sm">
                        {{ auth()->user()->name }}
                    </div>
                </div>

            </div>

            <div class="mt-5">
                <h3 class="text-gray-500 font-bold">
                    {{ __('Suggestion for you') }}

                    <ul>
                        @foreach ($suggestedusers as $suggested)
                            <li class="flex flex-row my-5 text-sm justify-items-center">

                                <div class="mr-5">

                                    <a href="/{{ $suggested->username }}">
                                        <img src="{{ $suggested->image }}"
                                            class="rounded-full h-9 w-9 border border-gray-300">
                                    </a>
                                </div>
                                <div class="flex flex-col grow">
                                    <a class="font-bold text-black" href="/{{ $suggested->username }}" >
                                        {{ $suggested->username }}</a>
                                        <div class="text-gray-500 text-sm">{{ $suggested->name }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </h3>
            </div>







        </div>




    </div>

</x-app-layout>
