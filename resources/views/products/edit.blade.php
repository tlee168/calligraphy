@extends('main')

@section('content')

    <h1>Edit: {{ $product->title }}</h1>
    <hr/>

<div class="content form-group row">
    <div class="col-xs-5 col-md-4">
        <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" />
    </div>
    <div class="col-xs-7 col-md-8">
    <!-- {!! Form::open(['method' => 'PATCH', 'url' => 'products', 'files' => true]) !!} -->
    <!-- Form model binding: bind an eloquent model to a form -->
    {!! Form::model($product, ['method' => 'PATCH', 'action' => ['ProductsController@update', $product->id], 'files' => true]) !!}

    @include('products.form', ['submitButtonText' => 'Update Product', 'method' => 'PATCH' ])

    {!! Form::close() !!}
    </div>

    @include('errlist')

</div>

@stop