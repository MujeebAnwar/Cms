@extends('layouts.admin')

@section('content')

    <h1>Create Post</h1>


    {!! Form::open(['method' => 'Post','action'=>'AdminPostController@store','files'=>true]) !!}

    <div class="form-group">

        {!!Form::label('Title', 'Title')!!}
        {!!Form::text('title',null, ['class'=>'form-control'])!!}


        @error('title')
        <span class="text-danger" role="alert">
            <strong >{{$message }}</strong>
        </span>
        @enderror

    </div>

    <div class="form-group">

        {!!Form::label('category_id', 'Category')!!}
        {!!Form::select('category_id',[''=>'Choose Option']+$categories,null, ['class'=>'form-control'])!!}

        @error('category_id')
            <span class="text-danger" role="alert">
                <strong >{{$message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">

        {!!Form::label('photo_id', 'Photo:')!!}
        {!!Form::file('photo_id',null, ['class'=>'form-control'])!!}

        @error('photo_id')
        <span class="text-danger" role="alert">
            <strong >{{$message }}</strong>
        </span>
        @enderror
    </div>



    <div class="form-group">

        {!!Form::label('body', 'Description')!!}
        {!!Form::textarea('body',null, ['class'=>'form-control'])!!}

        @error('body')
            <span class="text-danger" role="alert">
                <strong >{{$message }}</strong>
            </span>
        @enderror

    </div>

    <div class="form-group">
        {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop