
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! Form::label('year', 'Year:') !!}
    {!! Form::text('year', null, ['class' => 'form-control']) !!}
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
    {!! Form::label('availability', 'Availability:') !!}
    {!! Form::select('availability', ['1' => 'In Stock', '0' => 'Out of Stock'], null, ['class' => 'form-control']) !!}

    @if ($method !== 'PATCH')
    {!! Form::label('image', 'Choose an image:') !!}
    {!! Form::file('image') !!}
    @endif


    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $options, null, ['class' => 'form-control']) !!}

    {!! Form::hidden('user_id', Auth::user()->id) !!}

    {!! Form::label('tag_list', 'Tags:') !!}
    {!! Form::select('tag_list[]', $tags, isset($product) ? $product->tag_list->toArray() : null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}

    @if (isset($oldimage))
    {!! Form::hidden('oldimage', $oldimage) !!}
    @endif

    {!! Form::submit($submitButtonText, ['class' => 'btn  btn-primary form-control']) !!}