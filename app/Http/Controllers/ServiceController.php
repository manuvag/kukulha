<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$services = Service::orderBy('id', 'desc')->paginate(10);
	return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$service = Service::create($request->all());

	if($request->hasFile('file'))
	{
	    $filename = $service->slug . request()->file->getClientOriginalExtension();
	    request()->file->storeAs('public',  $filename);
		
	    $service->file()->create([
		'file' => $filename
	    ]);
	}

	return redirect()->route('services.index')->with('success', 'Servicio "' . $service->title . '" creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
	$service->update($request->all());

	if($request->hasFile('file'))
	{
	    $service->file()->delete();
	    $filename = $service->slug . request()->file->getClientOriginalExtension();

	    $service->file()->create([
		'file' => $filename
	    ]);
	    $service->save();
	}

	return redirect()->route('services.index')->with('success', 'Servicio "' . $service->title . '" editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
	$name = $service->title;

	$service->delete();

	return redirect()->route('services.index')->with('success', 'Servicio "' . $name . '" eliminado con éxito');
    }
}
