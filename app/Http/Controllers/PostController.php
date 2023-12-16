<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Comment;
use App\Models\Tag;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showPosts(){
        $posts = Post::with('user')->where('is_published', true)->where('is_unpublished', false)->get();
        $user_id = Auth::id();
        $role = User::findOrFail($user_id)->roles->role;
        $access = $role == 'Moderator' || $role == 'Admin';
        return view('posts.posts', compact('posts', 'access'));
    }

    public function showUnpublishedPosts() {
        $posts = Post::with('user')->where('is_published', false)->get();
        return view('posts.posts', compact('posts'));
    }

    public function create(){
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function addPost(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'tags' => 'array|exists:tags,id'
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();
        $post->tag()->attach($validatedData['tags']);

        return redirect('/posts')->with("message", "Ваш пост был отправлен на модерацию");
    }

    public function showPost($post_id)
    {
        $post = Post::with(['user', 'comment' => function($query) {
            $query->where('is_published', true);
        }])->findOrFail($post_id);
        // dd($post);
        $user_id = Auth::id();
        $role = User::findOrFail($user_id)->roles->role;
        $access = $role == 'Moderator' || $role == 'Admin';
        return view('posts.show', compact('post', 'access'));
    }

    public function edit($post_id)
    {
        $post = Post::findOrFail($post_id);
        $tags = Tag::all();
        $selectedTags = Tag::searchByPost($post_id)->get();
        return view('posts.edit', compact('post', 'tags', 'selectedTags'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();

        return redirect('/posts')->with('success', 'Post успешно обновлён');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post успешно удалён');
    }

    public function unpublish($id) {
        $post = Post::findOrFail($id);
        $post->is_unpublished = true;
        $post->save();
        return redirect('/posts')->with("message", "Пост снят с публикации");
    }

    // public function showResources() {
    //     $posts = Post::withTrashed()->get();
    //     return PostResource::collection($posts);
    // }
}
