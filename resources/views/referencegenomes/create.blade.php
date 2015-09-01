@extends('layouts.master')

@section('content')
<div class="col-md-6">
{!! Form::open(array('route' => 'referencegenomes.store',
 'class' => 'form', 
'files' => true,   //for file upload
'novalidate' => 'novalidate')) !!}
    
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
    {!! Form::label('Reference genome name') !!}
    {!! Form::text('genomename', null, array('required', 'class'=>'form-control', 'placeholder'=>'genome name')) !!}
</div>

<div class="form-group">
    {!! Form::label('genome type') !!}<br />
<!-- define a select form 
The Form::select method accepts four parameters. The first identifies the name of the field. The
second identifies array used to populate the select field’s id and name values for each option. The
third field, which in this example is set to null, identifies any options (by ID) that should be selected
by default. The fourth field identifies any HTML attributes which should be set. In this example we’re
ensuring the user can select multiple values. 

-->
    {!! Form::select('type', array_merge(['0' => 'Select a type'], $types), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('genome file') !!}
    {!! Form::file('file', null, array('class'=>'form-control', 'placeholder'=>'Choose file')) !!}
</div>
 
<div class="form-group">
    {!! Form::submit('Create List!', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
</div>

@endsection
