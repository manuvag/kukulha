<x-app-layout>
    <x-slot name="header">
	<h2 class="h4 font-weight-bold">Añadir Artículo</h2>
    </x-slot>

<div class="row">
    <div class="col-sm-12 col-md-6 mx-auto">
	<div class="card p-3">
	    {{ Form::open(['route' => 'posts.store', 'files' => true]) }}
	    @include('admin.posts.partials.form')
	    {{ Form::close() }}
	</div>
    </div>
</div>
</x-app-layout>
