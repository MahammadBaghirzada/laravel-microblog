<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
            'posts' => Post::query()->with('user')->paginate(3)
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
            'title' => ['required', 'string', 'max:20'],
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $request->user()->posts()->create($validated);
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
    public function edit(string $id)
    {
        return view('posts.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'content' => ['required', 'string', 'max:1000'],
        ]);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return 'destroy post from the database';
    }

    public function user($id, $locale = 'en')
    {
        //return $id;
        App::setLocale($locale);
        return view('posts.index');
    }

    public function toggleFollow($id)
    {
        //return $id;
        return 'logic for toggling like/dislike functionality';
    }
}
