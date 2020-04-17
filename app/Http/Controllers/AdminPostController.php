<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Post;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $dir ='photos';
    protected $data=[];
    public function index()
    {
        //
        $posts = Post::all();


        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id')->all();

        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->data = Validator::make($request->all(), [

            'title' => 'required||max:256',
            'category_id'=>'required',
            'photo_id'=>'required|image',
            'body' => 'required',


            ],

            [
                'title.required'=>'Title Required',
                'title.max'=>'Maximum 256 Character Allowed',
                'body.required' =>'Description Required',
                'photo_id.required' =>'Photo Required',
                'photo_id.image' =>'Only Image Allowed',
                'category_id.required' =>'Category Required'
            ]
        )->validate();


       if ($file=$request->file('photo_id'))
       {
           $this->uploadImage($file);
       }

        Auth::user()->posts()->create($this->data);
        return redirect('admin/posts');
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
    public function edit(Post $post)
    {

        $categories =Category::pluck('name','id')->all();

        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->data = Validator::make($request->all(), [

            'title' => 'required||max:256',
            'category_id'=>'required',
            'photo_id'=>'image',
            'body' => 'required',


        ],

            [
                'title.required'=>'Title Required',
                'title.max'=>'Maximum 256 Character Allowed',
                'body.required' =>'Description Required',
                'photo_id.image' =>'Only Image Allowed',
                'category_id.required' =>'Category Required'
            ]
        )->validate();


        unlink(public_path().$post->photo->path);
        $post->photo->delete();
        if ($file=$request->file('photo_id'))
        {
           $this->uploadImage($file);
        }

        $post->update($this->data);

        return redirect( URL::to('admin/posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImage($file)
    {
        $photo_name =  Carbon::now()->format('Y-m-d').'_post_'.$file->getClientOriginalName();

        $file->move($this->dir,$photo_name);

        $photo = Photo::create(['path'=>$photo_name]);

        $this->data['photo_id'] = $photo->id;
    }
}
