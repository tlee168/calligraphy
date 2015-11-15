@extends('main')

@section('content')
    <h1>添加新類別</h1>
    <hr/>

    @unless (Auth::check())
        {!! redirect(('auth/login')) !!}
    @endif

<div class="content form-group">
    {!! Form::open(['url' => 'categories']) !!}
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}

    {!! Form::submit('Add Category', ['class' => 'btn  btn-primary form-control']) !!}
    {!! Form::close() !!}

</div>

@include('errlist')

@stop