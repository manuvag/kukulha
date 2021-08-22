<div class="form-group">
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Categoría']) }}
</div>

<div class="form-group text-center">
    {{ Form::submit('Guardar', ['class' => 'btn btn-success']) }}
</div>
