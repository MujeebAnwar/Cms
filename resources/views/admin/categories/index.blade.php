@extends('layouts.admin')

@section('content')
<h1>Categories</h1>


    <div class="col-sm-6">

        @if(isset($category))
            {!! Form::model($category,['method' => 'PATCH','action'=>['AdminCategoriesController@update',$category->id]]) !!}
        @else
            {!! Form::open(['method' => 'Post','action'=>'AdminCategoriesController@store']) !!}

        @endif


        <div class="form-group">
            {!!Form::label('name', 'Name')!!}
            {!!Form::text('name',null, ['class'=>'form-control'])!!}

            @error('name')
                <span class="text-danger" role="alert">
                    <strong >{{$message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::submit(isset($category)?'Update Category':'Create Category',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>
    <div class="col-sm-6">
        @if(isset($categories))
        <table class="table table-hover">
           <thead>
              <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Edit</th>
                  <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
              <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->created_at->diffForHumans()}}</td>
                  <td>{{$category->updated_at->diffForHumans()}}</td>
                  <td><a href="{{URL::to('admin/categories/'.$category->id.'/edit')}}">
                      <button class="btn btn-primary">Edit</button></a></td>
                  <td>

                      {!! Form::open(['method' => 'DELETE','action'=>['AdminCategoriesController@destroy',$category->id]]) !!}

                      <div class="form-group">
                          {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                      </div>
                      {!! Form::close() !!}
                      </td>
              </tr>

             @endforeach

            </tbody>
          </table>

          @endif

        <div class="col-sm-6 col-sm-offset-2">
            {{$categories->links()}}
        </div>
    </div>


@stop