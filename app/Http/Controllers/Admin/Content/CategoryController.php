<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {

        $postCategories = PostCategory::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.category.index', compact('postCategories'));
    }


    public function create()
    {

        $parentCategories = PostCategory::whereNull('parent_id')->get();
        return view('admin.content.category.create', compact('parentCategories'));
    }


    public function store(PostCategoryRequest $request)
    {
        $inputs = $request->all();
        $inputs['slug'] = Str::replace(' ', '-', $inputs['name']) . '-' . Str::random(5);
        $inputs['image'] = 'image';
        $postCategory = PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index');
    }


    //public function show(PostCategory $postCategory){}


    public function edit(PostCategory $postCategory)
    {

        $parentCategories = PostCategory::whereNull('parent_id')->get();
        return view('admin.content.category.edit', compact('postCategory', 'parentCategories'));
    }


    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        $inputs = $request->all();
        $inputs['image'] = 'image';
        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index');
    }


    public function destroy(PostCategory $postCategory)
    {
        $result = $postCategory->delete();
        return redirect()->route('admin.content.category.index');
    }

    public function status(PostCategory $postCategory)
    {
        $postCategory->status = $postCategory->status == 0 ? 1 : 0;
        $result = $postCategory->save();

        if ($result){

            if ($postCategory->status == 0)
                return response()->json(['status' => true, 'checked' => false]);

            else
                return response()->json(['status' => true, 'checked' => true]);

        }

        else
            return response()->json(['status' => false]);


    }
}
