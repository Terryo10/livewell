<?php

namespace App\Http\Controllers;

use App\Models\BlogCategories;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function getPosts()
    {
        $posts = Post::all();
        $categories = BlogCategories::all();
        return view('blog.posts')
            ->with('posts', $posts)
            ->with('categories', $categories);
    }

    public function post($id)
    {
        $post = Post::find($id);
        
        return view('blog.singlePost')
            ->with('post', $post);
    }

    public function commentPost(Request $request)
    {
    }

    public function blogCategory($id)
    {
        $posts = Post::where('blog_category_id', '=', $id)->get();
        $categories = BlogCategories::all();
        $category = BlogCategories::find($id);
        return view('blog.blogCategoryFilter')
            ->with('posts', $posts)
            ->with('category', $category)
            ->with('categories', $categories);
    }

    public function blogSearch(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')->get();
        $categories = BlogCategories::all();
        return view('blog.posts')->with('posts', $posts)->with('categories', $categories);
    }
}
