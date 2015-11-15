@extends('main')

@section('content')

<h1>{{ $tag->name }}</h1>
<hr/>

@include('products')

@stop