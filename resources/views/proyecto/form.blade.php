<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('materias') }}
            {{ Form::select('materias_id', $materias, $proyecto->materias_id, ['class' => 'form-control' . ($errors->has('materias_id') ? ' is-invalid' : ''), 'placeholder' => 'Materias Id']) }}
            {!! $errors->first('materias_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            {{ Form::label('titulo') }}
            {{ Form::text('titulo', $proyecto->titulo, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Titulo']) }}
            {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $proyecto->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
        <div class="form-group">
    {{ Form::label('fecha_entrega') }}
    {{ Form::date('fecha_entrega', \Carbon\Carbon::parse($proyecto->fecha_entrega)->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('fecha_entrega') ? ' is-invalid' : '')]) }}
    {!! $errors->first('fecha_entrega', '<div class="invalid-feedback">:message</div>') !!}
</div>


        
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::select('status', ['Pendiente' => 'Pendiente', 'Completado' => 'Completado'], $proyecto->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Estado']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
