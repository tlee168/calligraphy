@extends('main')

@section('content')

<div class="content">

<article>
<div class="panel panel-info">

  <div class="panel-heading">
        <h3 class="panel-title">{{ $product->title }}</a></h3>
  </div>

  <div class="panel-body">

    <div class="media">
          <div class="media-left media-top">
            <a href="#">
              <img class="media-object" src="{{ asset($product->image) }}" alt="{{ $product->title }}" />
            </a>
          </div>

          <div class="media-body">
            <p>{{ $product->description }}</p>
            <div>Author: {{ $product->user['name'] }}</div>
            <div>Year: {{ $product->year }}</div>
            <div>Price: {{ $product->price }}</div>
            <div>Category: {{ $product->categoryName() }}</div>
            @unless ($product->tags->isEmpty())
                <div>
                    Tags:
                        @foreach ($product->tags as $tag)
                            <a href="/tags/{{ $tag->id }}" >{{ $tag->name }} &nbsp;</a>
                        @endforeach
                </div>
            @endunless

            @can ('update-product', $product)

                {!! Form::open(['method' => 'GET', 'action' => ['ProductsController@edit', $product->id]]) !!}

                {!! Form::submit('Edit') !!}

                {!! Form::close() !!}

                <br>

                <form action="/products/{{ $product->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button>Delete this product</button>
                </form>

            @endcan

          </div>
    </div>


  </div>
</div>
</article>

</div>

@stop