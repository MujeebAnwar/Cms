<?php

namespace App\Http\Controllers;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected  $input=[];
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $this->input = $request->all();


        if ($file = $request->file('photo_id'))
        {
           $this->uploadImage($file);
        }

        $this->input['password'] = bcrypt($request->password);

        User::create($this->input);

        return redirect(URL::to('admin/users'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request,User $user)
    {
        $this->input = $request->all();

        $user->photo->delete();
        if ($file = $request->file('photo_id'))
        {
           $this->uploadImage($file);
        }

        $user->update($this->input);

        return redirect(URL::to('admin/users'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        unlink(public_path().$user->photo->path);

        $user->photo->delete();
        return redirect(URL::to('admin/users'));
    }

    /**
     * @param $file
     * Upload Files
     */
    public function uploadImage($file)
    {
        $name = Carbon::now()->format('y-m-d').'_'.$file->getClientOriginalName();

        $file->move('photos',$name);

        $photo = Photo::create(['path'=>$name]);

        $this->input['photo_id']=$photo->id;

    }
}
