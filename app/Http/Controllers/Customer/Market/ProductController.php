<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Content\Comment;
use App\Models\Admin\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Product $product){

        //Auth::loginUsingId(1);
        Auth::logout();
        $relatedProducts = Product::all();
        return view('customer.market.product.index', compact('product', 'relatedProducts'));
    }

    public function addComment(Request $request, Product $product){

        $validated = $request->validate([
            'body' => 'required|min:1|max:2048',
        ]);

        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;
        $inputs['user_id'] = Auth::user()->id;
        $comment = Comment::create($inputs);
        return back()->with('swal-success', 'دیدگاه شما با موفقیت ثبت شد و پس از تایید، نمایش داده می شود');
    }

    public function addToFavorite(Product $product)
    {
        if(Auth::check())
        {
            $product->user()->toggle([Auth::user()->id]);

            if($product->user->contains(Auth::user()->id))
                return response()->json(['status' => 1]);

            else
                return response()->json(['status' => 2]);

        }

        else
            return response()->json(['status' => 3]);

    }
}
