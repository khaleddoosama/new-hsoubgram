<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->following()
            ->wherePivot('confirmed', true)
            ->pluck('users.id')
            ->push(Auth::id()); // Add self
    
        $post = Post::whereIn('user_id', $id)->latest()->get();
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
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $request->validate([
            'description' => 'required',
            'image'       => ['nullable', 'mimes:jpeg,jpg,png,gif'],
        ]);

        if ($request->hasFile('image')) {
            $image         = $request->file('image')->store('posts', 'public');
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()->back()->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {   
        $this->authorize('delete', $post);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $user=Auth::user();
        $post->delete();
        
        return redirect()->route('userprofile',Auth::user()->username)
                     ->with('success', 'Post deleted successfully!');

    }

    public function explore()
    {
        $posts = Post::whereRelation('owner', 'private_account', '=', 0)
            ->whereNot('user_id', auth()->id())
            ->simplePaginate(12);
        return view('posts.explore', compact('posts'));
    }
}