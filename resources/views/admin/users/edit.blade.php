@extends('layouts.admin')

@section('content')
    <h1>Create Users</h1>

    <div class="col-md-3">
        <img src="{{$user->photo?$user->photo->path:$user->defaultImage()}}" alt="" class="img-responsive img-rounded">
    </div>

    <div class="col-md-9">



    {!! Form::model($user,['method' => 'PATCH','action'=>['AdminUserController@update',$user->id],'files'=>true]) !!}

    <div class="form-group">

        {!!Form::label('name', 'Name:')!!}
        {!!Form::text('name',null, ['class'=>'pb-2 form-control'])!!}

        @error('name')
        <span class="text-danger" role="alert">
        <strong >{{$message }}</strong>
    </span>
        @enderror
    </div>

    <div class="form-group">
        {!!Form::label('email', 'Email:')!!}
        {!!Form::text('email',null, ['class'=>'form-control'])!!}

        @error('email')
        <span class="text-danger" role="alert">
        <strong>{{$message }}</strong>
    </span>
        @enderror
    </div>



    <div class="form-group">

        {!!Form::label('role_id', 'Role:')!!}
        {!!Form::select('role_id',[''=>'Choose Option']+$roles,null, ['class'=>'form-control'])!!}

        @error('role')
        <span class="text-danger" role="alert">
        <strong >{{$message }}</strong>
    </span>
        @enderror
    </div>
    <div class="form-group">
        {!!Form::label('file', 'Photo:')!!}
        {!!Form::file('photo_id',null, ['class'=>'form-control'])!!}

        @error('photo_id')
        <span class="text-danger" role="alert">
            <strong >{{$message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">

        {!!Form::label('is_active', 'Status:')!!}
        {!!Form::select('is_active',[0=>'Not Active',1=>'Active'],null, ['class'=>'form-control'])!!}

    </div>

    <div class="form-group">
        {!! Form::submit('Update User',['class'=>'btn btn-primary col-sm-3']) !!}
    </div>

    {!! Form::close() !!}


        {!! Form::open(['method' => 'DELETE','action'=>['AdminUserController@destroy',$user->id]]) !!}


        <div class="form-group">
            {!! Form::submit('Delete User',['class'=>'btn btn-danger col-sm-3']) !!}
        </div>

        {!! Form::close() !!}

    </div>
@endsection