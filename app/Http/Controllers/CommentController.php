<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addComment(Request $request, $post_id) {
        $validatedData = $request->validate([
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post_id;
        $comment->content = $validatedData['content'];
        $comment->save();

        return redirect('/posts/'.$post_id)->with("message", "Ваш comment был отправлен на модерацию");
    }

    public function publish($comment_id) {
        $comment = Comment::findOrFail($comment_id);
        $comment->is_published = true;
        $comment->save();
        return redirect('/moder/comments/unpublished')->with("message", 'Комментарий был опубликован');
    }

    public function showUnpublishedComments() {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        if (!$user->hasRole('Moderator') && !$user->hasRole('Admin')) {
            return redirect('/posts')->with('message', 'Недостаточно прав доступа');
        }
        $comments = Comment::with('post')->where('is_published', false)->get();
        $user_id = Auth::id();
        $role = User::findOrFail($user_id)->roles->role;
        $access = $role == 'Moderator' || $role == 'Admin';
        return view('comments.comments', compact('comments', 'access'));
    }

    public function delete($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();
        return redirect('/moder/comments/unpublished')->with('message', 'Комментарий успешно удалён');
    }
}
