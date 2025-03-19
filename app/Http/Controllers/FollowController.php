<?php
namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        // Ensure the user is not trying to follow themselves
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot follow yourself.');
        }

        // Follow the user
        auth()->user()->follow($user);

        return redirect()->back()->with('status', 'Follow request sent.');
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);
        return back()->with('success', 'You have unfollowed ' . $user->name);
    }
}