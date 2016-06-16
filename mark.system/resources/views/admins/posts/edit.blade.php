@extends('layouts.dashboard')

@section('title') Users @stop

@section('content')

{{ Form::model($entry, array('route' => array('updateentry', $entry->id), 'files' => true, 'method' => 'PUT')) }}
	
<div class='form-group'>
    {{ Form::label('name', 'Tên file') }}
    {{ Form::text('name', $entry->original_filename, ['placeholder' => 'Tên file', 'class' => 'form-control']) }}
</div>

<div class='form-group'>
    {{ Form::label('file', 'File') }}
    {{ Form::file('filefield', null, ['placeholder' => 'File', 'class' => 'form-control']) }}
</div>

<div class='form-group'>
    {{ Form::submit('Xác nhận', ['class' => 'btn btn-primary']) }}
</div>

{{ Form::close() }}

@stop