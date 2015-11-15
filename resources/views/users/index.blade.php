@extends('main')

@section('content')

    <h1>作者總覽</h1>
    <hr/>


<div class="content">
    @foreach ($users as $user)
        @if ( \App\User::find($user['id'])->products->toArray())
        <article>

            <h2><a href="{{ url('/users', $user['id']) }}">{{ $user['name'] }}</a></h2>

        </article>
        @endif
    @endforeach
</div>

@stop