<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Posts;
use App\Models\Tags;
use App\Models\Users;
use App\Models\Contains;

class PostsController extends Controller{
    // All Blog posts page
    public function home(){
        $posts = Posts::all();
        $tags = Tags::all();
        $filterTags = [];
        return view('home', compact('posts', 'tags', 'filterTags'));
    }


    // Add new Blog form
    public function newPostForm(){
        $tags = Tags::all();
        return view('add_post', compact('tags'));
    }


    // Insert new Blog to DB
    public function insertPost(PostRequest $request){
        $title =  $request->input('title');
        $content = $request->input('content');
        $tags =  $request->input('tags');
        $user = Users::find(1);

        $post = Posts::create([
            'title' => $title,
            'content' => $content,
            'date' => now(),
            'u_id' => $user->id
        ]);

        if (!empty($tags)) {
            foreach ($tags as $tagName) {
                $tag = Tags::firstOrCreate([
                    'name' => $tagName
                ]);

                $post->tags()->attach($tag->id);
            }
        }

        return redirect()->route('home')->with('success', 'Blog created successfully!');
    }


    // Delete Blog post
        public function deletePost($id){
        $post = Posts::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Blog can not be found.');
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Blog deleted sucessfully!');
    }


    // Modify Blog post
    public function editPost($id){
        $post = Posts::find($id);
        $recentTags = $post->tags->pluck('id')->toArray();
        $tags = Tags::all();

        if (!$post) {
            return redirect()->back()->with('error', 'Blog can not be found.');
        }

        return view('edit_post', compact('post', 'tags', 'recentTags'));
    }


    // Update Blog post and connecting Tags in DB
    public function updatePost(PostRequest $request, $p_id){
        $title =  $request->input('title');
        $content = $request->input('content');
        $tags =  $request->input('tags');

        $post = Posts::find($p_id);

        if (!$post) {
            return redirect()->back()->with('error', 'Blog can not be found.');
        }

        $post->update([
            'title' => $title,
            'content' => $content,
        ]);

        if (!empty($tags)) {
            $post->tags()->detach();

            foreach ($tags as $tagName) {
                $tag = Tags::firstOrCreate(['name' => $tagName]);
                $post->tags()->attach($tag->id);
            }
        }

        return redirect()->route('home')->with('success', 'Blog modified successfully');
    }


    // Single Blog post
    public function showPost($id){
        $post = Posts::find($id);
        $tags = Tags::all();

        if (!$post) {
            return redirect()->route('home')->with('error', 'This blog can not be found!');
        }

        return view('post', compact('post', 'tags'));
    }


    // Filter Blog posts
    public function filterPost(Request $request){
        $tags = Tags::all();

        if (!empty($request->input('tags'))) {
            $validated = $request->validate([
                'tags' => 'nullable|array',
                'tags.*' => 'numeric',
            ]);

            $filterTags = $validated['tags'];
            $postIDs = Contains::getPostsByTagIds($filterTags);
            $posts = Posts::whereIn('id', $postIDs)->get();
        } else {
            $filterTags = [];
            $posts = Posts::all();
        }

        if ($posts->isEmpty()) {
            return view('home', compact('posts', 'tags', 'filterTags'))->with('error', 'Sorry, there are no blog posts with the given tags.');
        }

        return view('home', compact('posts', 'tags', 'filterTags'));
    }
}
