<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'bio',
        'image',
        'email',
        'password',
        'private_account',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    //relations
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withPivot('confirmed');
    }

    public function follower()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id')->withPivot('confirmed');
    }

    //end of relations

    public function suggestedUsers()
    {

        $user = Auth::user();

        return User::where('id', '!=', $user->id)
            ->whereNotIn('id', $user->following()->pluck('users.id')) // Exclude followed users
            ->inRandomOrder()
            ->limit(5)
            ->get();
    }

    public function follow(User $user)
    {
        if ($this->id === $user->id) {
            return; // Prevent users from following themselves
        }

        if ($user->private_account) {
            // If the user has a private account, the follow request is pending
            $this->following()->attach($user, ['confirmed' => false]);
        } else {
            // If the user has a public account, the follow is automatically confirmed
            $this->following()->attach($user, ['confirmed' => true]);
        }

    }
    public function unfollow(User $user)
    {
        return $this->following()->detach($user->id);
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_user_id', $user->id)->where('confirmed', true)->exists();
    }

    public function is_pending(User $user)
    {
        return $this->following()->where('following_user_id', $user->id)->where('confirmed', false)->exists();
    }

    public function pending_followers()
    {
        return $this->follower()->where('confirmed', false);
    }

    public function confirm(User $user)
    {
        return $this->follower()
            ->where('user_id', $user->id)
            ->update(['confirmed' => 1]);
    }

    public function deleteFollowReq(User $user)
    {
        return $this->follower()->detach($user);
    }
}