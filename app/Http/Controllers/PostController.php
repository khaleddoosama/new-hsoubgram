<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post           = Post::all();
        $suggestedusers = Auth::user()->suggestedUsers();
        return view('posts.index', ['post' => $post, 'suggestedusers' => $suggestedusers]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->image);
        $data = $request->validate([
            'description' => 'required',
            'image'       => ['required', 'mimes:jpeg,jpg,png,gif'],
        ]);

        $image = $request['image']->store('posts', 'public');

        $data['image']       = $image;
        $data['slug']        = Str::random(10);
        $data['user_id']     = Auth::user()->id;
        $data['description'] = $request->description;
        Post::create($data);
        // Auth::user()->posts()->create($data);
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function explore()
    {
        $posts = Post::whereRelation('owner', 'private_account', '=', 0)
            ->whereNot('user_id', auth()->id())
            ->simplePaginate(12);
        return view('posts.explore', compact('posts'));
   }
}