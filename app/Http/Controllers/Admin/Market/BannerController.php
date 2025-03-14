<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BannerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Market\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.market.banner.create');
    }

    public function store(BannerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();


        if ($request->hasFile('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');
            $result = $imageService->save($request->file('image'));

            if ($result === false)
                return redirect()->route('admin.market.banner.index')->with('toast-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['image'] = $result;
        }

        $banner = Banner::create($inputs);
        return redirect()->route('admin.market.banner.index')->with('swal-success', 'بنر  جدید با موفقیت ثبت شد');
    }

    public function edit(Banner $banner)
    {
        return view('admin.market.banner.edit', compact('banner'));
    }

    public function update(BannerRequest $request, Banner $banner, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {

            if (!empty($banner->image))
                $imageService->deleteImage($banner->image);

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');
            $result = $imageService->save($request->file('image'));

            if ($result === false)
                return redirect()->route('admin.market.banner.index')->with('toast-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['image'] = $result;

        }

        $banner->update($inputs);
        return redirect()->route('admin.market.banner.index')->with('swal-success', 'بنر با موفقیت ویرایش شد');
    }

    public function destroy(Banner $banner)
    {
        $result = $banner->delete();
        return redirect()->route('admin.market.banner.index')->with('swal-success', 'بنر با موفقیت حذف شد');
    }



    public function status(Banner $banner)
    {
        $banner->status = $banner->status == 0 ? 1 : 0;
        $result = $banner->save();
        if ($result) {
            if ($banner->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

}
