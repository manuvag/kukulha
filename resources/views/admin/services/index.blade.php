<x-app-layout>
    <x-slot name="header">
	<div class="d-flex justify-content-between align-items-center">
	    <h2 class="h4 font-weight-bold">Services</h2>
	    <a class="btn btn-secondary" href="{{ route('services.create') }}">Añadir Servicio</a>
	</div>
    </x-slot>

    <table class="table table-responsive-sm">
	<thead>
	    <tr>
		<th>Imágen</th>
		<th>Titulo</th>
		<th colspan="2">&nbsp;</th>
	    </tr>
	</thead>
	<tbody>
	    @foreach($services as $service)
		<tr>
		    <td width="100px"><img src="{{ Storage::url($service->file->file) }}" class="img-fluid" alt=""></td>
		    <td>{{ $service->title }}</td>
		    <td width="10px"><a class="btn btn-info btn-sm" href="{{ route('services.edit', $service->id) }}">Editar</a></td>
		    @livewire('confirm-cancel', ['model' => $service->id, 'route' => 'services.destroy'])  
		</tr>
	    @endforeach
	</tbody>
    </table>
</x-app-layout>


