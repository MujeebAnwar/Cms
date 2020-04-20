@extends('layouts.admin')

@section('content')


    @if(count($comments) > 0)

        <h1>Replies</h1>

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
            @foreach($comments as $comment)

                @foreach($comment->replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td><a href="{{route('post.home',$reply->comment->post->id)}}">View Post</a></td>

                    <td>

                        {!! Form::open(['method' => 'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}

                        @if($reply->is_active)

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

                        {!! Form::open(['method' => 'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}

                    </td>

                </tr>

                    @endforeach
            @endforeach

            </tbody>
        </table>

    @else
        <h1 class="text-center">No Replies</h1>
    @endif


@stop