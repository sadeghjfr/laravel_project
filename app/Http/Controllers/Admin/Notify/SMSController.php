<?php

namespace App\Http\Controllers\admin\notify;

use App\Models\Notify\SMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;

class SMSController extends Controller
{
    public function index()
    {
        $sms = SMS::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.sms.index', compact('sms'));
    }

    public function create()
    {
        return view('admin.notify.sms.create');
    }

    public function store(SMSRequest $request)
    {
        $inputs = $request->all();

        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $sms = SMS::create($inputs);
        return redirect()->route('admin.notify.sms.index')->with('toast-success', 'پیامک با موفقیت ثبت شد');
    }

    //public function show($id){}

    public function edit(SMS $sms)
    {
        return view('admin.notify.sms.edit', compact('sms'));
    }

    public function update(SMSRequest $request, SMS $sms)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $sms->update($inputs);
        return redirect()->route('admin.notify.sms.index')->with('toast-success', 'پیامک با موفقیت ویرایش شد');
    }

    public function destroy(SMS $sms)
    {
        $result = $sms->delete();
        return redirect()->route('admin.notify.sms.index')->with('toast-success', 'پیامک با موفقیت حذف شد');
    }


    public function status(SMS $sms){

        $sms->status = $sms->status == 0 ? 1 : 0;
        $result = $sms->save();

        if($result){
            if($sms->status == 0){
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
