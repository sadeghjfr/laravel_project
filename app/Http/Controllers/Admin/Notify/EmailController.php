<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Models\Notify\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.email.index', compact('emails'));
    }

    public function create()
    {
        return view('admin.notify.email.create');

    }

    public function store(EmailRequest $request)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $email = Email::create($inputs);
        return redirect()->route('admin.notify.email.index')->with('toast-success', 'ایمیل با موفقیت ثبت شد');
    }

    //public function show($id){}

    public function edit(Email $email)
    {
        return view('admin.notify.email.edit', compact('email'));
    }

    public function update(EmailRequest $request, Email $email)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $email->update($inputs);
        return redirect()->route('admin.notify.email.index')->with('toast-success', 'ایمیل با موفقیت ویرایش شد');
    }

    public function destroy(Email $email)
    {
        $result = $email->delete();
        return redirect()->route('admin.notify.email.index')->with('toast-success', 'ایمیل با موفقیت حذف شد');
    }


    public function status(Email $email){

        $email->status = $email->status == 0 ? 1 : 0;
        $result = $email->save();

        if($result){
            if($email->status == 0){
                return response()->json(['status' => true, 'checked' => false]);
            }
            else{
                return response()->json(['status' => true, 'checked' => true]);
            }
        }
        else{
            return response()->json(['status' => false]);
        }

    }

}
