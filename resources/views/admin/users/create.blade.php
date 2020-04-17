@extends('layouts.admin')

@section('content')
<h1>Create Users</h1>


{!! Form::open(['method' => 'Post','action'=>'AdminUserController@store','files'=>true]) !!}

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
    {!!Form::label('password', 'Password:')!!}
    {!!Form::password('password',['class'=>'form-control'])!!}

    @error('password')
        <span class="text-danger" role="alert">
            <strong >{{$message }}</strong>
        </span>
        @enderror
</div>


<div class="form-group">

     {!!Form::label('role_id', 'Role:')!!}
     {!!Form::select('role_id',[''=>'Choose Option']+$roles,null, ['class'=>'form-control'])!!}

    @error('role_id')
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

    {!!Form::label('is_active', 'Status:')!!}
    {!!Form::select('is_active',[0=>'Not Active',1=>'Active'],0, ['class'=>'form-control'])!!}

</div>

<div class="form-group">
    {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
@endsection