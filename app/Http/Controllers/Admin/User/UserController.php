<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $admins = User::where('user_type', 1)->get();
        $customers = User::where('user_type', 0)->get();
        return view('admin.user.index', compact('admins', 'customers'));
    }


    public function create()
    {
        return view('admin.user.create');
    }


    public function store(UserRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if ($result === false)
                return redirect()->route('admin.user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['profile_photo_path'] = $result;
        }

        $inputs['password'] = Hash::make($request->password);
        $user = User::create($inputs);
        return redirect()->route('admin.user.index')->with('swal-success', 'کاربر جدید با موفقیت ثبت شد');
    }


    //public function show($id){}


    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('profile_photo_path'))
        {
            if(!empty($user->profile_photo_path))
                $imageService->deleteImage($user->profile_photo_path);

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if($result === false)
                return redirect()->route('admin.user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['profile_photo_path'] = $result;
        }

        $user->update($inputs);
        return redirect()->route('admin.user.index')->with('swal-success', 'کاربر با موفقیت ویرایش شد');
    }

    public function destroy(User $user)
    {
        $result = $user->forceDelete();
        return redirect()->route('admin.user.index')->with('swal-success', 'کاربر با موفقیت حذف شد');
    }


    public function status(User $user){

        $user->status = $user->status == 0 ? 1 : 0;
        $result = $user->save();

        if($result){

            if($user->status == 0)
                return response()->json(['status' => true, 'checked' => false]);

            else
                return response()->json(['status' => true, 'checked' => true]);
        }

        else
            return response()->json(['status' => false]);
    }


    public function activation(User $user){

        $user->activation = $user->activation == 0 ? 1 : 0;
        $result = $user->save();

        if($result){
            if($user->activation == 0)
                return response()->json(['status' => true, 'checked' => false]);

            else
                return response()->json(['status' => true, 'checked' => true]);
        }

        else
            return response()->json(['status' => false]);
    }
}
