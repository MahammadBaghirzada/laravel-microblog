<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::query()->withCount('usersThatLike')->with('user')->orderByDesc('users_that_like_count')->paginate(3)
        ]);
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
        $validated = $request->validate([
            'title' => 'required|string|max:20',
            'content' => 'required|string|max:1000',
        ]);

        $post = $request->user()->posts()->create($validated);
        // foreach (User::whereNot('id', auth()->user()->id)->cursor() as $user) {
        //     $user->notify(new NewPost($post));
        // }
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, $locale = 'en')
    {
        // return $id;
        App::setLocale($locale);
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $post->update($validated);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
        return redirect(route('posts.index'));
    }

    public function user($id, $locale = 'en')
    {
        $user = User::query()->find($id);
        App::setLocale($locale);
        return view('posts.index', [
            'posts' => Post::query()->withCount('usersThatLike')->with('user')->where('user_id',$id)->orderByDesc('users_that_like_count')->paginate(3),
            'user' => $user->name
        ]);
    }

    public function toggleFollow(Request $request, User $user)
    {
        $loggedInUser = auth()->user();
        if ($loggedInUser->isFollowing($user)) {
            $loggedInUser->following()->detach($user);
        } else {
            $loggedInUser->following()->attach($user);
        }
        return back();
    }
}
