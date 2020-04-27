@extends('layouts.admin')

@section('content')

    @include('includes.tinyeditor')
    <h1>Edit Post</h1>


    <div class="col-md-3">
        <img src="{{$post->photo?$post->photo->path:$post->user->defaultImage()}}" alt="" class="img-responsive img-rounded">
    </div>

    <div class="col-md-9">

        {!! Form::model($post,['method' => 'PATCH','action'=>['AdminPostController@update',$post->id],'files'=>true]) !!}

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
            {!! Form::submit('Update User',['class'=>'btn btn-primary col-sm-3']) !!}
        </div>

        {!! Form::close() !!}


        {!! Form::open(['method' => 'DELETE','action'=>['AdminPostController@destroy',$post->id]]) !!}


        <div class="form-group">
            {!! Form::submit('Delete User',['class'=>'btn btn-danger col-sm-3']) !!}
        </div>

        {!! Form::close() !!}

    </div>
@stop