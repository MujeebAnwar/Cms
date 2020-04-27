<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $replies=CommentReply::paginate(10);
        return view('admin.comments.replies.index',compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       $post = Post::findOrFail($id);
       $comments = $post->comments;
       return view('admin.comments.replies.show',compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //

       $commentReply = CommentReply::findOrFail($id);

       $commentReply->update($request->all());

        return redirect()->back();
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

    public function commentReply(Request $request)
    {


        $user = Auth::user();

        $data = [

            'comment_id' => $request->comment_id,
            'author'  => $user->name,
            'photo_id'   => $user->photo?$user->photo->id:0,
            'email'   => $user->email,
            'body'    => $request->body,
        ];

        CommentReply::create($data);

        $request->session()->flash('reply_massage','Your reply has been submitted and its waiting moderation');

        return redirect()->back();
    }

    public function singleCommentReplies($id)
    {

        $comment= Comment::findOrFail($id);

        $replies=$comment->replies()->paginate(10);

        return view('admin.comments.replies.single',compact('replies'));
    }
}
