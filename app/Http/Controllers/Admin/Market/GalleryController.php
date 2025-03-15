<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Market\Gallery;
use App\Models\Admin\Market\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.gallery.create', compact('product'));
    }

    public function store(Request $request, Product $product, ImageService $imageService)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,webp|max:2048',
        ]);

        $inputs = $request->all();

        if ($request->hasFile('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false)
                return redirect()->route('admin.market.gallery.index', $product->id)->with('swal-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['image'] = $result;
            $inputs['product_id'] = $product->id;
            $gallery = Gallery::create($inputs);
            return redirect()->route('admin.market.gallery.index', $product->id)->with('swal-success', 'تصویر با موفقیت ثبت شد');
        }

        return redirect()->route('admin.market.gallery.index', $product->id);
    }

    public function destroy(Product $product,Gallery $gallery, ImageService $imageService)
    {
        $result = $gallery->forceDelete();
        $imageService->deleteDirectoryAndFiles($gallery->image['directory']);
        return redirect()->route('admin.market.gallery.index', $product->id)->with('swal-success', 'تصویر با موفقیت حذف شد');
    }
}
