<x-app-layout>
    <x-slot name="header">
	<div class="d-flex justify-content-between align-items-center">
	    <h2 class="h4 font-weight-bold">Categorías</h2>
	    <a class="btn btn-secondary" href="{{ route('categories.create') }}">Añadir categoría</a>
	</div>
    </x-slot>

    <table class="table table-responsive-sm">
	<thead>
	    <tr>
		<th>Categoría</th>
		<th>URL</th>
		<th colspan="2">&nbsp;</th>
	    </tr>
	</thead>
	<tbody>
	    @foreach($categories as $category)
		<tr>
		    <td>{{ $category->name }}</td>
		    <td>{{ $category->slug }}</td>
		    <td width="10px"><a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category->id) }}">Editar</a></td>
		    @livewire('confirm-cancel', ['model' => $category->id, 'route' => 'categories.destroy'])  	
		</tr>
	    @endforeach
	</tbody>
    </table>
</x-app-layout>


