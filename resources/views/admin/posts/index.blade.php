<x-app-layout>
    <x-slot name="header">
	<div class="d-flex justify-content-between align-items-center">
	    <h2 class="h4 font-weight-bold">Artículos</h2>
	    <a class="btn btn-secondary" href="{{ route('posts.create') }}">Añadir artículo</a>
	</div>
    </x-slot>

    <table class="table table-responsive-sm">
	<thead>
	    <tr>
		<th>Imágen</th>
		<th>Titulo</th>
		<th>Categoría</th>
		<th colspan="2">&nbsp;</th>
	    </tr>
	</thead>
	<tbody>
	    @foreach($posts as $post)
		<tr>
		    <td width="100px"><img src="{{ Storage::url($post->file->file) }}" class="img-fluid" alt=""></td>
		    <td>{{ $post->title }}</td>
		    <td>{{ $post->category->name }}</td>
		    <td width="10px"><a class="btn btn-info btn-sm" href="{{ route('posts.edit', $post->id) }}">Editar</a></td>
		    @livewire('confirm-cancel', ['model' => $post->id, 'route' => 'posts.destroy'])
		</tr>
	    @endforeach
	</tbody>
    </table>
</x-app-layout>


