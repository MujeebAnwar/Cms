@extends('layouts.admin')

@section('content')
<h1>Users</h1>
    <table class="table">
       <thead class="thead-dark">
          <tr>
              <th>Id</th>
              <th>Photo</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Created</th>
              <th>Updated</th>
          </tr>

        </thead>

        <tbody>
        @if($users)
            @foreach($users as $user)
          <tr>

              <td>{{$user->id}}</td>
              <td><img height="60" src="{{$user->photo?$user->photo->path:$user->defaultImage()}}" alt=""></td>
              <td><a href="{{URL::to('admin/users/'.$user->id.'/edit')}}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>{{$user->role?$user->role->name:'No Role'}}</td>
              <td>{{$user->is_active==1 ?'Active':'Not Active'}}</td>
              <td>{{$user->created_at?$user->created_at->diffForHumans():'Not Set'}}</td>
              <td>{{$user->updated_at?$user->updated_at->diffForHumans():'Not Set'}}</td>
          </tr>
          @endforeach
        @endif
        </tbody>
      </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$users->render()}}
        </div>
    </div>
@endsection