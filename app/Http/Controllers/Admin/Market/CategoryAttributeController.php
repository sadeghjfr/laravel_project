<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;
use App\Models\Admin\Market\CategoryAttribute;
use App\Models\Admin\Market\ProductCategory;

class CategoryAttributeController extends Controller
{
    public function index()
    {
        $attributes = CategoryAttribute::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.attribute.index', compact('attributes'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.market.attribute.create', compact('categories'));
    }

    public function store(CategoryAttributeRequest $request)
    {
        $inputs = $request->all();
        $productCategory = CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.attribute.index')->with('swal-success', 'ویژگی جدید با موفقیت ثبت شد');
    }


    public function edit(CategoryAttribute $attribute)
    {
        $categories = ProductCategory::all();
        return view('admin.market.attribute.edit', compact('categories', 'attribute'));
    }

    public function update(CategoryAttributeRequest $request, CategoryAttribute $attribute)
    {
        $inputs = $request->all();
        $attribute->update($inputs);
        return redirect()->route('admin.market.attribute.index')->with('swal-success', 'ویژگی با موفقیت ویرایش شد');
    }

    public function destroy(CategoryAttribute $attribute)
    {
        $result = $attribute->delete();
        return redirect()->route('admin.market.attribute.index')->with('swal-success', 'ویژگی با موفقیت حذف شد');
    }

}
