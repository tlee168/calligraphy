@extends('main')

@section('content')
    <h1>Create Tag</h1>
    <hr/>

<div class="content form-group">
    {!! Form::open(['url' => 'tags']) !!}
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}

    {!! Form::submit('Add Tag', ['class' => 'btn  btn-primary form-control']) !!}
    {!! Form::close() !!}

</div>

@include('errlist')

@stop