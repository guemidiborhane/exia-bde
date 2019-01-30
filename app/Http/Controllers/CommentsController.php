<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request, $id)
    {
        $model = $request->input('model');
        $comment = $model::find($id)->comments()->create(['body' => $request->input('body'), 'user_id' => \Auth::user()->id]);

        return response()->json(Comment::with('user:id,lname,fname')->find($comment->id));
    }

    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();
        return response()->json(['done' => true]);
    }
}
