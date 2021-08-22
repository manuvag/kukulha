<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$works = Work::orderBy('id', 'desc')->paginate(10);
	return view('admin.works.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$work = Work::create($request->all());

	if($request->has('files'))
	{
	    $files = $request->file('files');
	    $i = 1;

	    foreach($files as $file)
	    {
		$filename = $work->slug . '-' . $i . $file->getClientOriginalExtension();
		Storage::putFileAs('public',$file, $filename);

		$file = $work->files()->create([
		    'file' => $filename
		]);
		$i++;
	    }
	}
	$work->save();

	return redirect()->route('works.index')->with('success', 'Proyecto "' . $work->client . '" creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        return view('admin.works.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
	$work->update($request->all());

	if($request->has('files'))
	{
	    $work->files()->delete();

	    $files = $request->file('files');
	    $i = 1;

	    foreach($files as $file)
	    {
		$filename = $work->slug . '-' . $i . $file->getClientOriginalExtension();
		Storage::putFileAs('public',$file, $filename);

		$file = $work->files()->create([
		    'file' => $filename
		]);
		$i++;
	    }
	}
	$work->save();
	return redirect()->route('works.index')->with('success', 'Proyecto "' . $work->client . '" editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
	$name = $work->client;
	$work->files()->delete();
	$work->delete();
	return redirect()->route('works.index')->with('success', 'Proyecto "' . $name . '" eliminado con éxito');
    }
}
