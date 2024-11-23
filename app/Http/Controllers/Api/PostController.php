<?php

namespace App\Http\Controllers\Api;

// import Model "Post"
use App\Models\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// import API Resurce "PostResource"
use App\Http\Resources\PostResource;

// import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index() {
        // get all posts
        $posts = Post::latest()->paginate(5);

        // return ollection of posts as a resource
        return new PostResource(true, 'List Data Posts', $posts);
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */
    public function store(Request $request) {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'image' => 'required|image\mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'content' => 'required',
        ]);
    }
}
