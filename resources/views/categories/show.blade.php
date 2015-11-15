@extends('main')

@section('content')

<h1>{{ $category->name }}</h1>
<hr/>

@include('products')


@stop