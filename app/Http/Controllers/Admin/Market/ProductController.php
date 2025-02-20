<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Content\PostCategory;
use App\Models\Admin\Market\Brand;
use App\Models\Admin\Market\Product;
use App\Models\Admin\Market\ProductCategory;
use App\Models\Admin\Market\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.product.index', compact('products'));
    }

    public function create()
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.create', compact('productCategories', 'brands'));
    }


    public function store(ProductRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$realTimestampStart);

        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false)
                return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['image'] = $result;
        }


        DB::transaction(function () use ($inputs){

            $metas = $this->createMetas($inputs['meta_key'], $inputs['meta_value']);
            $product = Product::create($inputs);

            foreach ($metas as $key => $value) {

                $meta = ProductMeta::create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id' => $product->id,
                ]);
            }

        });


        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول جدید با موفقیت ثبت شد');
    }

    public function createMetas($keys, $values){

        return array_filter(array_combine($keys, $values), function($value, $key) {
            return !is_null($key) && $key !== '' && !is_null($value) && $value !== '';
        }, ARRAY_FILTER_USE_BOTH);
    }


    public function show($id)
    {
        //
    }


    public function edit(Product $product)
    {

        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.edit', compact('productCategories', 'brands', 'product'));
    }

    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();

        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        if ($request->hasFile('image')) {

            if (!empty($product->image))
                $imageService->deleteDirectoryAndFiles($product->image['directory']);

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false)
                return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['image'] = $result;
        }

        else {
            if (isset($inputs['currentImage']) && !empty($product->image)) {
                $image = $product->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }

        $inputs['slug'] = null;

        DB::transaction(function () use ($inputs, $product){

            $metas = $this->createMetas($inputs['meta_key'], $inputs['meta_value']);
            $product->update($inputs);

            foreach ($product->metas as $meta){

                $meta->delete();
            }

            foreach ($metas as $key => $value) {

                $meta = ProductMeta::create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id' => $product->id,
                ]);
            }

        });

        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول  شما با موفقیت ویرایش شد');
    }


    public function destroy(Product $product)
    {
        $result = $product->delete();
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت حذف شد');
    }

    public function status(Product $product)
    {
        $product->status = $product->status == 0 ? 1 : 0;
        $result = $product->save();

        if ($result) {

            if ($product->status == 0)
                return response()->json(['status' => true, 'checked' => false]);

            else
                return response()->json(['status' => true, 'checked' => true]);

        } else
            return response()->json(['status' => false]);


    }

    public function marketable(Product $product)
    {
        $product->marketable = $product->marketable == 0 ? 1 : 0;
        $result = $product->save();

        if ($result) {

            if ($product->marketable == 0)
                return response()->json(['status' => true, 'checked' => false]);

            else
                return response()->json(['status' => true, 'checked' => true]);

        } else
            return response()->json(['status' => false]);


    }

}
