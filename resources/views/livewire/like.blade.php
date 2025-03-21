    <div >
        <a wire:click="toggle_like">

            @if($post->liked(Auth::user()->id))

            <li class="bx bxs-heart text-red-600 text-3xl hover:text-gray-400 cursor-pointer mr-3">

            @else

            <li class="bx bx-heart text-3xl hover:text-gray-400 cursor-pointer mr-3">

            @endif  
            </li>
        </a>
       
    </div>  
