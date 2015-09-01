@extends('layouts.master')

@section('content')
<div class="col-md-6">
{!! Form::open(array('route' => 'referencegenomes.store', 'class' => 'form', 'novalidate' => 'novalidate')) !!}
    
<h2>Create reference genome</h2>

@if (count($errors) > 0)
	<div class="alert alert-danger">
		There were some problems with your input.<br />
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div class="form-group">
    {!! Form::label('') !!}
    {!! Form::text('genomename', null, array('required', 'class'=>'form-control', 'placeholder'=>'genome name')) !!}
</div>

<div class="form-group">
    {!! Form::label('genome type') !!}<br />
    {!! Form::select('Referencegenometype', array_merge(['0' => 'Select a type'], $types), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('genome file') !!}
    {!! Form::text('file', null, array('class'=>'form-control', 'placeholder'=>'Choose file')) !!}
</div>
 
<div class="form-group">
    {!! Form::submit('Create List!', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
</div>

@endsection
