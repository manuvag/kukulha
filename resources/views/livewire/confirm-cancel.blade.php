<div>
 <td width="10px">
    {{ Form::open(['route' => ["$route",  $model], 'method' => 'DELETE', 'class' => 'delete'])}}
    {{ Form::submit('Eliminar', ['class' => 'btn btn-danger btn-sm']) }}
    {{ Form::close() }}
</td>

@push('scripts')
    <script>
	let del = document.getElementsByClassName('delete')
	for(let i=0; i< del.length; i++){
	    del[i].addEventListener('submit', function(e){
		e.preventDefault();
		Swal.fire({
		    title: '¿Estas seguro de continuar?',
		    text: "¡No podras revertir esto!",
		    icon: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#3085d6',
		    cancelButtonColor: '#d33',
		    confirmButtonText: '¡Eliminar!'
		}).then((result) => {
		    if (result.isConfirmed) {
			this.submit();    
		    }
		})
	    })
	}
    </script>
@endpush
</div>
