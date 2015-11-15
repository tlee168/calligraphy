@extends('main')

@section('content')

    <h1>類別總覽</h1>
    <hr/>

<div class="content">
    @foreach ($categories as $category)
    <article>

        <h2><a href="{{ url('/categories', $category->id) }}">{{ $category->name }}</a></h2>

    </article>
    @endforeach
</div>

@stop