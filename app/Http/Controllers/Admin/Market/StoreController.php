<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreRequest;
use App\Http\Requests\Admin\Market\StoreUpdateRequest;
use App\Models\Admin\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.store.index', compact('products'));
    }

    public function addToStore(Product $product)
    {
        return view('admin.market.store.add-to-store', compact('product'));
    }

    public function store(StoreRequest $request, Product $product)
    {
        $product->marketable_number += $request->marketable_number;
        $product->save();
        Log::info("receiver => {$request->receiver}, deliverer => {$request->deliverer}, description => {$request->description}, add => {$request->marketable_number}");
        return redirect()->route('admin.market.store.index')->with('swal-success', 'موجودی جدید با موفقیت ثبت شد');
    }

    public function edit(Product $product)
    {
        return view('admin.market.store.edit', compact('product'));
    }

    public function update(StoreUpdateRequest $request, Product $product)
    {
        $inputs = $request->all();
        $product->update($inputs);
        return redirect()->route('admin.market.store.index')->with('swal-success', 'موجودی با موفقیت ویرایش شد');
    }

}
