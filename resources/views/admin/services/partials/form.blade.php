<div class="form-group">
    {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Titulo']) }}
    @error('title')
    <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
@enderror	
</div>

<div class="input-group">
    <div class="custom-file mb-3">
	{{ Form::label('file', 'Imagen Principal', ['class' => 'custom-file-label']) }}
	{{ Form::file('file', ['class' => 'custom-file-input', 'multiple']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::textarea('description', null, ['class' => 'form-control' , 'id' => 'body']) }}
</div>


<div class="d-flex justify-content-center">
    {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
	 ClassicEditor
	    .create( document.querySelector( '#body' ), {
		toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
	    } )
	    .then( editor => {
		console.log( editor );
	    })
	    .catch( error => { 
		console.error( error );
	    });    
    </script>

@endpush
