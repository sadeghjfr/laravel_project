<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Content\Comment;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.comment.index', compact('comments'));
    }

    public function show(Comment $comment)
    {
        $this->seen($comment);
        return view('admin.content.comment.show', compact('comment'));
    }

    function seen(Comment $comment){

        if ($comment->status === 'unseen'){
            $comment->status = 'waiting';
            $comment->save();
        }
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
        return redirect()->route('admin.content.comment.index')->with('toast-error', 'کامنت با موفقیت حذف شد');
    }


    public function answer(CommentRequest $request, Comment $comment){

        if ($comment->parent_id == null){

            $comment->status = 'approved';
            $comment->save();

            $inputs = $request->all();
            $inputs['user_id'] = 1;
            $inputs['parent_id'] = $comment->id;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['status'] = 'approved';

            $comment = Comment::create($inputs);
            return redirect()->route('admin.content.comment.index')->with('toast-success', 'پاسخ با موفقیت ثبت شد');
        }

        else
            return redirect()->route('admin.content.comment.index')->with('toast-error', 'خطا');

    }

    //public function create(){}

    //public function edit($id){}

    //public function update(Request $request, $id){}

}
