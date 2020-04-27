<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index()
    {

        $posts = Post::all()->count();

        $categories = Category::all()->count();

        $comments = Comment::all()->count();
        return view('admin.index',compact('posts','categories','comments'));
    }

}
