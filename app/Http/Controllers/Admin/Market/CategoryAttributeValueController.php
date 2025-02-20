<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeValueRequest;
use App\Models\Admin\Market\CategoryAttribute;
use App\Models\Admin\Market\CategoryAttributeValue;
use Illuminate\Http\Request;

class CategoryAttributeValueController extends Controller
{

    public function index(CategoryAttribute $attribute)
    {
        return view('admin.market.attribute.value.index', compact('attribute'));
    }


    public function create(CategoryAttribute $attribute)
    {
        return view('admin.market.attribute.value.create', compact('attribute'));
    }


    public function store(CategoryAttributeValueRequest $request ,CategoryAttribute $attribute)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $attribute->id;
        $value = CategoryAttributeValue::create($inputs);
        return redirect()->route('admin.market.value.index', $attribute->id)->with('swal-success', 'مقدار ویژگی با موفقیت ثبت شد');
    }


    public function edit(CategoryAttribute $attribute, CategoryAttributeValue $value)
    {
        return view('admin.market.attribute.value.edit', compact('attribute', 'value'));
    }


    public function update(CategoryAttributeValueRequest $request , CategoryAttribute $attribute, CategoryAttributeValue $value)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $attribute->id;
        $value->update($inputs);
        return redirect()->route('admin.market.value.index', $attribute->id)->with('swal-success', 'مقدار ویژگی با موفقیت ویرایش شد');
    }

    public function destroy(CategoryAttribute $attribute, CategoryAttributeValue $value)
    {
        $result = $value->delete();
        return redirect()->route('admin.market.value.index', $attribute->id)->with('swal-success', 'مقدار ویژگی با موفقیت حذف شد');
    }
}
