@extends('layouts.admin')

@section('content')

<h1>All Posts</h1>

<table class=" table table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Body</th>
        <th>User</th>
        <th>Category</th>
{{--        <th></th>--}}
        <th>Created</th>
        <th>Updated</th>
    </tr>

    </thead>

    <tbody>
    @if($posts)
        @foreach($posts as $post)
            <tr>

                <td>{{$post->id}}</td>
                <td><img height="60" src="{{$post->photo?$post->photo->path:$post->user->defaultImage()}}" alt=""></td>
                <td><a href="{{URL::to('admin/posts/'.$post->id.'/edit')}}">{{$post->title}}</a></td>
                <td>{{$post->body}}</td>
                <td>{{$post->user?$post->user->name:'No User'}}</td>
                <td>{{$post->category?$post->category->name:'UnCategorize'}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@stop