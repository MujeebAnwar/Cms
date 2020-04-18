<?php

namespace App\Http\Controllers;

use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AdminPhotoController extends Controller
{
    //

    public function index()
    {
        $photos  = Photo::all();
        return view('admin.media.index',compact('photos'));
    }

    public function upload()
    {

        return view('admin.media.upload');
    }

    public function store(Request $request)
    {

        $data = $request->validate([

            'file' =>'image'
        ]);

        if ($file = $request->file('file'))
        {
            $photo_name = Carbon::now()->format('Y-m-d').'_img_'.$file->getClientOriginalName();

            $file->move('photos',$photo_name);

            Photo::create(['path'=>$photo_name]);
        }
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path().$photo->path);
        $photo->delete();

        return redirect(URL::to('admin/media'));
    }
}
