@extends('main')

@section('content')

<h1>{{ $user->name }}</h1>
<br>
<p>{{ $user->description }}</p>
<hr/>


@include('products')

@stop