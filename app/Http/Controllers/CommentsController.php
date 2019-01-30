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

    public function destroy(Request $request, $comment_id)
    {
        if ($request->input('report')) {
            Comment::find($comment_id)->delete();
        } else {
            if ($comment = Comment::find($comment_id)) {
                $comment->delete();
            } elseif ($comment = Comment::withTrashed()->find($comment_id)) {
                $comment->forceDelete();
            }
        }
        return response()->json(['done' => true]);
    }

    public function restore($id)
    {
        $comment = Comment::withTrashed()->find($id);
        if ($comment) {
            $comment->deleted_at = null;
            $comment->save();
        }
        return response()->json(['done']);
    }
}
