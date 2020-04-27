@extends('layouts.blog-post')

@section('content')


    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" style="height:300px;width:900px" src="{{$post->photo?$post->photo->path:$post->user->defaultImage()}}" alt="900x300">

    <hr>

    <!-- Post Content -->
    <p class="lead">{!! $post->body !!}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    @if(Session::has('comment_massage'))

        <div class="alert alert-success">
            {{session('comment_massage')}}
        </div>

        @endif

    @if(Auth::check())
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!! Form::open(['method' => 'Post','action'=>'PostCommentsController@store']) !!}

        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">

            {!!Form::textarea('body',null, ['class'=>'form-control','rows'=>3])!!}
        </div>
        <div class="form-group">
            {!! Form::submit('Post Comment',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    <hr>

        {{--  Disqus Commenting System      --}}
{{--    <div id="disqus_thread"></div>--}}
{{--    <script>--}}

{{--        /**--}}
{{--         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.--}}
{{--         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/--}}
{{--        /*--}}
{{--        var disqus_config = function () {--}}
{{--        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable--}}
{{--        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable--}}
{{--        };--}}
{{--        */--}}
{{--        (function() { // DON'T EDIT BELOW THIS LINE--}}
{{--            var d = document, s = d.createElement('script');--}}
{{--            s.src = 'https://project-lcjpbihlgj.disqus.com/embed.js';--}}
{{--            s.setAttribute('data-timestamp', +new Date());--}}
{{--            (d.head || d.body).appendChild(s);--}}
{{--        })();--}}
{{--    </script>--}}
{{--    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>--}}
{{--    <script id="dsq-count-scr" src="//project-lcjpbihlgj.disqus.com/count.js" async></script>--}}
    @endif
    <!-- Posted Comments -->

    <!-- Comment -->
    @if(count($comments)>0)
        @foreach($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" style="height: 65px; width: 65px;" src="{{$comment->post->user->photo?$comment->post->user->photo->path:$comment->post->user->defaultImage()}}" alt="">
                </a>

                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>

                    <p>{{$comment->body}}</p>
                    <!-- Nested Comment -->

                    @if(session('reply_massage'))
                        <div class="alert alert-success">
                            {{session('reply_massage')}}
                        </div>
                    @endif
                    <div class="comment-reply-container">
                        <button class="toggle-reply btn btn-primary pull-right" id="reply-form">Reply</button>
                    </div>



            <div class="comment-reply ">

                {!! Form::open(['method' => 'Post','action'=>'CommentRepliesController@commentReply']) !!}

                <div class="form-group">
                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    {!!Form::textarea('body',null, ['class'=>'form-control','rows'=>3])!!}
                </div>
                <div class="form-group">

                    {!! Form::button('<i class="fa fa-reply"></i> Reply',['type'=>'submit','class'=>'btn btn-primary']) !!}

                </div>

                {!! Form::close() !!}

            </div>
                    @if($comment->replies)

                        @foreach($comment->replies as $reply)

                            @if($reply->is_active)
                            <div class="media" id="nested-comment">
                                <a class="pull-left" href="#">
                                    <img class="media-object" height="65" width="65" src="{{$reply->comment->post->user->photo?$reply->comment->post->user->photo->path:$reply->comment->post->user->defaultImage()}}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->author}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h4>
                                    <p>{{$reply->body}}</p>
                                </div>



                            </div>
                            @endif
                        @endforeach
                     @endif
            </div>
            </div>

    @endforeach

    @endif


@stop

@section('categories')
    <h4>Blog Categories</h4>
    <div class="row">

            <ul class="list-unstyled">
            @foreach($categories as $category)

                    <div class="col-lg-6">
                        <li><a href="#">{{$category->name}}</a>

                    </div>

                @endforeach

            </ul>


    </div>
@stop

@section('script')
<script>

    $(document).ready(function () {
       $('.toggle-reply').click('click',function () {

           $('.comment-reply').slideToggle('slow');

       });

    });
</script>
@stop