<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function coupon()
    {
        return view('admin.market.discount.coupon');
    }

    public function couponCreate()
    {
        return view('admin.market.discount.coupon-create');
    }

    public function common()
    {
        return view('admin.market.discount.common');
    }

    public function commonCreate()
    {
        return view('admin.market.discount.common-create');
    }

    public function amazing()
    {
        return view('admin.market.discount.amazing');
    }

    public function amazingCreate()
    {
        return view('admin.market.discount.amazing-create');
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
