<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$posts  = Post::orderBy('id', 'desc')->paginate(10);
	return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
	return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$post = Post::create($request->all());

	if($request->hasFile('file')){
	    $filename = $post->slug . '.' . $request->file->getClientOriginalExtension();
	    request()->file->storeAs('public', $filename);

	    $post->file()->create([
		'file' => $filename
	    ]);
	    $post->save();
	}

	return redirect()->route('posts.index')->with('success', 'Artículo "' . $post->title . '" creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
	$categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
	return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
	$post->update($request->all());
	if($request->hasFile('file'))
	{
	    $post->file()->delete();
	    $filename = $post->slug . '.' . $request->file->getClientOriginalExtension();
	    request()->file->storeAs('public', $filename);

	    $post->file()->create([
		'file' => $filename
	    ]);
	    $post->save();
	}
	return redirect()->route('posts.index')->with('success', 'Artículo "' . $post->title . '" editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
	$name = $post->title;

	$post->delete();

	return redirect()->route('posts.index')->with('success', 'Artículo "' . $name . '" eliminado con éxito');
    }
}
