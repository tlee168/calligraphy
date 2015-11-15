@extends('main')

@section('content')
    <h1>添加新作品</h1>
    <hr/>

    @unless (Auth::check())
        {!! redirect(('auth/login')) !!}
    @endif

<div class="content form-group">
    {!! Form::open(['url' => 'products', 'files' => true]) !!}

    @include('products.form', ['submitButtonText' => 'Add Product', 'method' => 'POST'])

    {!! Form::close() !!}

    @include('errlist')

</div>

@stop