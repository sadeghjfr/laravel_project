<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FAQRequest;
use App\Models\Admin\Content\FAQ;

class FAQController extends Controller
{

    public function index()
    {
        $faqs = FAQ::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.faq.index', compact('faqs'));
    }


    public function create()
    {
        return view('admin.content.faq.create');
    }


    public function store(FAQRequest $request)
    {

        $inputs = $request->all();
        $faq = FAQ::create($inputs);
        return redirect()->route('admin.content.faq.index')->with('swal-success', 'سوال جدید با موفقیت ثبت شد');
    }


    //public function show($id){}


    public function edit(FAQ $faq)
    {
        return view('admin.content.faq.edit', compact('faq'));
    }


    public function update(FAQRequest $request, FAQ $faq)
    {
        $inputs = $request->all();
        $inputs['slug'] = null;
        $faq->update($inputs);
        return redirect()->route('admin.content.faq.index')->with('swal-success', 'سوال با موفقیت ویرایش شد');
    }


    public function destroy(FAQ $faq)
    {
        $result = $faq->delete();
        return redirect()->route('admin.content.faq.index')->with('swal-success', 'سوال با موفقیت حذف شد');
    }

    public function status(FAQ $faq)
    {
        $faq->status = $faq->status == 0 ? 1 : 0;
        $result = $faq->save();

        if ($result){

            if ($faq->status == 0)
                return response()->json(['status' => true, 'checked' => false]);

            else
                return response()->json(['status' => true, 'checked' => true]);

        }

        else
            return response()->json(['status' => false]);


    }

}
