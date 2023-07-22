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

        $validated = $request->validate([
            'email' => 'required|unique:posts|max:255',
            'body' => 'required',
            'name' => 'required',
        ]);

        if ($validated) {
            if (Auth::user()->subscribed) {
                $post = Post::find($request->post_id);
                $post->comments()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'body' => $request->body,
                    'post_id' => $request->post_id,
                ]);
                return redirect()->back()->with('success', 'Comment added successfully');
            } else {
                return redirect()->back()->withErrors('success', 'Comment added successfully');
            }
        }
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
