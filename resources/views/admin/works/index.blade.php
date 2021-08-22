<x-app-layout>
    <x-slot name="header">
	<div class="d-flex justify-content-between align-items-center">
	    <h2 class="h4 font-weight-bold">Proyectos</h2>
	    <a class="btn btn-secondary" href="{{ route('works.create') }}">Añadir proyecto</a>
	</div>
    </x-slot>

    <table class="table table-responsive-sm">
	<thead>
	    <tr>
		<th>Imágen</th>
		<th>Cliente</th>
		<th colspan="2">&nbsp;</th>
	    </tr>
	</thead>
	<tbody>
	    @foreach($works as $work)
		<tr>
		    <td width="100px"><img src="{{ Storage::url($work->getFile($work)) }}" class="img-fluid" alt=""></td>
		    <td>{{ $work->client }}</td>
		    <td width="10px"><a class="btn btn-info btn-sm" href="{{ route('works.edit', $work->id) }}">Editar</a></td>
		    @livewire('confirm-cancel', ['model' => $work->id, 'route' => 'works.destroy'])
		</tr>
	    @endforeach
	</tbody>
    </table>
</x-app-layout>


