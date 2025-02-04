<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        return view('admin.notify.email.index');
    }


    public function create()
    {
        return view('admin.notify.email.create');
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
