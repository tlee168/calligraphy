@extends('main')

@section('content')

    <h1>Tags</h1>
    <hr/>

<div class="content">
    @foreach ($tags as $tag)
    <article>

        <h2><a href="{{ url('/tags', $tag->id) }}">{{ $tag->name }}</a></h2>

    </article>
    @endforeach
</div>

@stop