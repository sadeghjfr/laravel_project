<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Content\PostCategory;
use App\Models\Admin\Market\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.brand.index', compact('brands'));
    }


    public function create()
    {
        return view('admin.market.brand.create');
    }


    public function store(BrandRequest $request, ImageService $imageService)
    {

        $inputs = $request->all();

        if ($request->hasFile('logo')){

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->save($request->file('logo'));

            if ($result === false)
                return redirect()->route('admin.market.brand.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['logo'] = $result;
        }

        $brand = Brand::create($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند با موفقیت ثبت شد');
    }

    public function edit(Brand  $brand)
    {
        return view('admin.market.brand.edit', compact('brand'));
    }


    public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {

        $inputs = $request->all();

        if($request->hasFile('logo'))
        {
            if(!empty($brand->logo))
                $imageService->deleteImage($brand->logo);

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->save($request->file('logo'));

            if($result === false)
                return redirect()->route('admin.market.brand.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['logo'] = $result;
        }

        $inputs['slug'] = null;
        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند با موفقیت ویرایش شد');
    }


    public function destroy(Brand $brand)
    {
        $result = $brand->delete();
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند با موفقیت حذف شد');
    }

    public function status(Brand $brand)
    {
        $brand->status = $brand->status == 0 ? 1 : 0;
        $result = $brand->save();

        if ($result){

            if ($brand->status == 0)
                return response()->json(['status' => true, 'checked' => false]);

            else
                return response()->json(['status' => true, 'checked' => true]);

        }

        else
            return response()->json(['status' => false]);


    }

}
