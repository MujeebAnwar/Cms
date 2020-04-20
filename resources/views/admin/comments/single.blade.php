@extends('layouts.admin')

@section('content')


    @if($reply)

        <h1>Comment</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>


            </tr>

            </thead>
            <tbody>


                <tr>
                    <td>{{$reply->comment->id}}</td>
                    <td>{{$reply->comment->author}}</td>
                    <td>{{$reply->comment->email}}</td>
                    <td>{{$reply->comment->body}}</td>
                    <td><a href="{{route('post.home',$reply->comment->post->id)}}">View Post</a></td>
                    <td><a href="{{route('single.comment.reply',$reply->comment->id)}}">View Reply</a></td>

                    <td>

                        {!! Form::open(['method' => 'PATCH','action'=>['PostCommentsController@update',$reply->comment->id]]) !!}

                        @if($reply->comment->is_active)

                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Un Approve',['class'=>'btn btn-danger']) !!}
                            </div>
                        @else

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit('Approve',['class'=>'btn btn-success']) !!}
                            </div>

                        @endif

                        {!! Form::close() !!}
                    </td>

                    <td>

                        {!! Form::open(['method' => 'DELETE','action'=>['PostCommentsController@destroy',$reply->comment->id]]) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}

                    </td>

                </tr>



            </tbody>
        </table>

    @else
        <h1 class="text-center">No </h1>
    @endif


@stop