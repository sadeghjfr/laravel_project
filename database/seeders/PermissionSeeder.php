<?php

namespace Database\Seeders;

use App\Models\User\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        $permissions = [
            'users' => ['مشاهده کاربران', 'ایجاد کاربران', 'ویرایش کاربران', 'حذف کاربران'],
            'posts' => ['مشاهده پست ها', 'ایجاد پست ها', 'ویرایش پست ها', 'حذف پست ها'],
            'post-categories' => ['مشاهده دسته بندی پست ها', 'ایجاد دسته بندی پست ها', 'ویرایش دسته بندی پست ها', 'حذف دسته بندی پست ها'],

        ];

        foreach ($permissions as $group => $perms) {
            foreach ($perms as $permission) {
                Permission::firstOrCreate(['name' => $permission, 'description' => $group, 'created_at' => now()]);
            }
        }
    }
}
