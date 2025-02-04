<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function index()
    {
        return view('admin.notify.sms.index');
    }


    public function create()
    {
        return view('admin.notify.sms.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
