<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:20',
            'content' => 'required|string|max:1000',
        ]);

        $post = $request->user()->posts()->create($validated);

        return response()->json([
            'post' => $post
        ]);
    }
}
