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
        $photos  = Photo::paginate(10);
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


    }


    /**
     * Delete Bulk Media
     */

    public function deleteMedia(Request $request)
    {
        if (isset($request->delete_single))
        {
            $this->destroy($request->photo);
            return redirect()->back();
        }

        if (isset($request->delete_all) && $request->checkBoxArray!='delete')
        {
            $photos = Photo::findOrFail($request->checkBoxArray);


            foreach ($photos as $photo)
            {
                $photo->delete();
            }
        }
        else
        {
            return redirect()->back()->with(['data' => 'Please Select Atleast One option']);
        }

        return redirect()->back();

    }
}
