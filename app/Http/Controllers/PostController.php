<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); 
        
        return view('post.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:150',
            'body' => 'required', 
        ]);

        $input = $request->all();

        $post = Post::create($input);
    
        return back()->with('success',' Post baru berhasil dibuat.');
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        return view('post.edit', [
                'post' => $post
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:150',
            'body' => 'required', 
        ]);
                
        $post = Post::find($id)->update($request->all()); 
                
        return back()->with('success',' Data telah diperbaharui!');
    }
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return back()->with('success',' Penghapusan berhasil.');
    }
}
