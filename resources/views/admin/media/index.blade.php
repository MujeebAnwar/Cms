@extends('layouts.admin')

@section('content')

    <h1>Media</h1>
    @if(Session('data'))
    <p class="alert alert-danger">{{Session('data')}}</p>
    @endif
    @if($photos)
        <form action="{{route('delete.media')}}" method="POST" class="form-inline">
            @csrf
            <div class="form-group">
                <select name="checkBoxArray" id="" class="form-control">
                    <option value="delete">Delete</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" name='delete_all' class="btn btn-primary" value="Submit">
            </div>


        <table class="table table-hover">
           <thead>
              <tr>
                  <th><input type="checkbox" id="options"></th>
                  <th>Id</th>
                  <th>Photo</th>
                  <th>Created</th>
                  <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            @foreach($photos as $photo)
              <tr>
                  <td>
                      <input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{$photo->id}}">
                  </td>
                  <td>{{$photo->id}}</td>
                  <td><img height="50" src="{{$photo->path}}" alt=""></td>
                  <td>{{$photo->created_at?$photo->created_at:'No Time'}}</td>
                  <td>

                      <input type="hidden" name="photo" value="{{$photo->id}}">
                      <div class="form-group">
                          <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
                      </div>


                  </td>
              </tr>

            @endforeach

            </tbody>
          </table>
        </form>
            @endif
    <div class="col-sm-6 col-sm-offset-5">
        {{$photos->links()}}
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#options').on('click',function () {

               if(this.checked)
               {
                   $('.checkBoxes').each(function () {

                       this.checked = true;
                   });
               }
               else {
                   $('.checkBoxes').each(function () {

                       this.checked = false;
                   });
               }
            });


        });
    </script>
    @endsection