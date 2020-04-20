@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">

@stop

@section('content')

<h1>Upload Photos</h1>
<br>

    {!! Form::open(['method' => 'Post','action'=>'AdminPhotoController@store','class'=>'dropzone']) !!}

    {!! Form::close() !!}

@stop

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
@stop





