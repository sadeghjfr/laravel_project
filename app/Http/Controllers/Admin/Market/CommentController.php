<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Admin\Content\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{

    public function index()
    {

        $unseenComments = Comment::where('status', 'unseen')->where('commentable_type', 'App\Models\Admin\Market\Product')->get();
        $waitingComments = Comment::where('status', 'waiting')->where('commentable_type', 'App\Models\Admin\Market\Product')->get();
        $approvedComments = Comment::where('status', 'approved')->where('commentable_type', 'App\Models\Admin\Market\Product')->get();
        return view('admin.market.comment.index', compact('unseenComments', 'waitingComments', 'approvedComments'));
    }

    public function show(Comment $comment)
    {
        if ($comment->status === 'unseen'){
            $comment->status = 'waiting';
            $comment->save();
        }

        return view('admin.market.comment.show', compact('comment'));
    }

    public function status(Comment $comment)
    {

        $comment->status = $comment->status == 'waiting' ? 'approved' : 'waiting';
        $comment->save();
        return  Redirect::back()->with('swal-success', 'تغییرات با موفقیت اعمال شد');
    }

    public function destroy(Comment $comment)
    {
        $result = $comment->delete();
        return redirect()->route('admin.market.comment.index')->with('swal-success', 'نظر با موفقیت حذف شد');
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
            return redirect()->route('admin.market.comment.index')->with('swal-success', 'پاسخ با موفقیت ثبت شد');
        }

        else
            return redirect()->route('admin.market.comment.index')->with('toast-error', 'خطا');

    }

    public function deleteAnswer(Comment $answerComment)
    {
        $comment = $answerComment->parent;
        $result = $answerComment->forceDelete();
        return redirect()->route('admin.market.comment.show', compact('comment'))->with('swal-success', 'پاسخ با موفقیت حذف شد');
    }

}
