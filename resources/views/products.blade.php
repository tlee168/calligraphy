

<div class="content container row">

@foreach ($products as $product)

<article class="col-xs-6 col-sm-4">
<div class="panel panel-info">

  <div class="panel-heading">
        <h3 class="panel-title"><a href="{{ url('/products', $product->id) }}">{{ $product->title }}</a><br>
        <small>{{ \App\User::find($product->user_id)->name }}, {{ $product->year }}</small>
        </h3>
  </div>

  <div class="panel-body">
    <div class="media">
      <div class="media-left media-top">
        <a href="#">
          <img class="media-object" src="{{ asset(str_replace('products/','products/sm/',$product->image) ) }}" alt="{{ $product->title }}" />
        </a>
      </div>
      <div class="media-body">
        <p>{{ str_limit($product->description, 40) }}</p>
<!--
        @can ('update-product', $product)
            <form action="/products/{{ $product->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button>Delete this product</button>
            </form>
        @endcan
-->

      </div>
    </div>
  </div>

</div>
</article>

@endforeach

</div>