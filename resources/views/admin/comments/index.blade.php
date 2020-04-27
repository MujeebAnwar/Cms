@extends('layouts.admin')

@section('content')


    @if(count($comments) > 0)

        <h1>Comments</h1>

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
                      <tr>
                          <td>{{$comment->id}}</td>
                          <td>{{$comment->author}}</td>
                          <td>{{$comment->email}}</td>
                          <td>{{$comment->body}}</td>
                          <td><a href="{{route('post.home',$comment->post->id)}}">View Post</a></td>
                          <td><a href="{{route('single.comment.reply',$comment->id)}}">View Replies</a></td>

                          <td>

                              {!! Form::open(['method' => 'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}

                              @if($comment->is_active)

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

                              {!! Form::open(['method' => 'DELETE','action'=>['PostCommentsController@destroy',$comment->id]]) !!}

                              <div class="form-group">
                                  {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                              </div>

                              {!! Form::close() !!}

                          </td>

                      </tr>
                        
                        @endforeach

                    </tbody>
                  </table>

        @else
        <h1 class="text-center">No Comments</h1>
    @endif
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$comments->links()}}
        </div>
    </div>

@stop