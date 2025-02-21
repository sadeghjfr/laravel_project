<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Admin\Content\Comment;
use App\Models\Admin\Ticket\Ticket;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function index()
    {
        $unseenComments = Comment::where('status', 'unseen')->where('commentable_type', 'App\Models\Admin\Content\Post')->get();
        $waitingComments = Comment::where('status', 'waiting')->where('commentable_type', 'App\Models\Admin\Content\Post')->get();
        $approvedComments = Comment::where('status', 'approved')->where('commentable_type', 'App\Models\Admin\Content\Post')->get();
        return view('admin.content.comment.index', compact('unseenComments', 'waitingComments', 'approvedComments'));
    }

    public function show(Comment $comment)
    {
        if ($comment->status === 'unseen'){
            $comment->status = 'waiting';
            $comment->save();
        }

        return view('admin.content.comment.show', compact('comment'));
    }

    public function status(Comment $comment)
    {

        $comment->status = $comment->status == 'waiting' ? 'approved' : 'waiting';
        $comment->save();
        return  Redirect::back()->with('toast-success', 'تغییرات با موفقیت اعمال شد');
    }

    public function destroy(Comment $comment)
    {
        $result = $comment->delete();
        return redirect()->route('admin.content.comment.index')->with('toast-success', 'کامنت با موفقیت حذف شد');
    }


    public function answer(CommentRequest $request, Comment $comment){

        if ($comment->parent_id == null){

            $inputs = $request->all();
            $inputs['user_id'] = 13;
            $inputs['parent_id'] = $comment->id;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['status'] = 'answer';

            $comment = Comment::create($inputs);
            return redirect()->route('admin.content.comment.index')->with('toast-success', 'پاسخ با موفقیت ثبت شد');
        }

        else
            return redirect()->route('admin.content.comment.index')->with('toast-error', 'خطا');

    }

    public function deleteAnswer(Comment $answerComment)
    {
        $comment = $answerComment->parent;
        $result = $answerComment->forceDelete();
        return redirect()->route('admin.content.comment.show', compact('comment'))->with('toast-success', 'پاسخ با موفقیت حذف شد');
    }

}
