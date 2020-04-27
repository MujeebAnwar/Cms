@extends('layouts.blog-home')

@section('content')
    <div class="col-md-8">
    @if(count($posts)>0)

        @foreach($posts as $post)



        <!-- Third Blog Post -->

        <h2>
            <a href="{{route('post.home',$post->id)}}">{{$post->title}}</a>
        </h2>
        <p class="lead">
            by <a href="index.php">{{$post->user->name}}</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}</p>
        <hr>
        <img class="img-responsive" style="height:300px;width:900px" src="{{$post->photo?$post->photo->path:$post->user->defaultImage()}}" alt="">
        <hr>
        <p>{!! Str::limit($post->body,100) !!}</p>
        <a class="btn btn-primary" href="{{route('post.home',$post->id)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

        <!-- Pager -->



        @endforeach
    @endif
        </div>


@endsection

@section('category')

    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">

            <!-- /.col-lg-6 -->

            <ul class="list-unstyled">
                @if($categories)
                    @foreach($categories as $category)
                    <div class="col-lg-6">

                        <li><a href="#">{{$category->name}}</a></li>

                    </div>
                    @endforeach
            </ul>
                @endif

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

@stop
@section('pagination')
<div class="col-sm-6 col-sm-offset-5">

    {{$posts->links()}}
</div>
    @stop