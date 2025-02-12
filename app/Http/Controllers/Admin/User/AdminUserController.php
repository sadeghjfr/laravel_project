<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{

    public function index()
    {
        $admins = User::where('user_type', 1)->get();
        return view('admin.user.admin-user.index', compact('admins'));
    }


    public function create()
    {
        return view('admin.user.admin-user.create');
    }


    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if ($result === false)
                return redirect()->route('admin.user.admin-user.index')->with('toast-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['profile_photo_path'] = $result;
        }

        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;
        $user = User::create($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('toast-success', 'ادمین جدید با موفقیت ثبت شد');
    }


    //public function show($id){}


    public function edit(User $admin)
    {
        return view('admin.user.admin-user.edit', compact('admin'));
    }

    public function update(AdminUserRequest $request, User $admin, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('profile_photo_path'))
        {
            if(!empty($admin->profile_photo_path))
                $imageService->deleteImage($admin->profile_photo_path);

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if($result === false)
                return redirect()->route('admin.user.admin-user.index')->with('toast-error', 'آپلود تصویر با خطا مواجه شد');

            $inputs['profile_photo_path'] = $result;
        }

        $admin->update($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('toast-success', 'ادمین با موفقیت ویرایش شد');
    }

    public function destroy(User $admin)
    {
        $result = $admin->forceDelete();
        return redirect()->route('admin.user.admin-user.index')->with('toast-success', 'ادمین با موفقیت حذف شد');
    }


    public function status(User $admin){

        $admin->status = $admin->status == 0 ? 1 : 0;
        $result = $admin->save();
        if($result){
            if($admin->status == 0){
                return response()->json(['status' => true, 'checked' => false]);
            }
            else{
                return response()->json(['status' => true, 'checked' => true]);
            }
        }
        else{
            return response()->json(['status' => false]);
        }

    }


    public function activation(User $admin){
        $admin->activation = $admin->activation == 0 ? 1 : 0;
        $result = $admin->save();
        if($result){
            if($admin->activation == 0){
                return response()->json(['status' => true, 'checked' => false]);
            }
            else{
                return response()->json(['status' => true, 'checked' => true]);
            }
        }
        else{
            return response()->json(['status' => false]);
        }

    }
}
