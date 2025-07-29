<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\adminSetting;
use App\Models\Brand;
use App\Models\category;
use App\Models\CompanyInfo;
use App\Models\contactInfo;
use App\Models\Device;
use App\Models\ExperienceVideo;
use App\Models\ServiceType;
use App\Models\socialLink;
use App\Models\TermAndPrivacy;
use App\Models\User;
use App\Models\WatchRepair;
use App\Models\websiteSetting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::create([
            'description' => 'N/A',
        ]);

        User::create([
            'username'          => 'admin',
            'name'              => 'Admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt(1),
            'image'             => 'user.jpg',
            'type'              => 1,
        ]);

        CompanyInfo::create([
            'name'        => 'Nayon Telecom Care',
            'email'       => 'nayoncare@gmail.com',
            'hotline'     => '09678149149',
            'whatsapp'    => '01810023529',
            'address'     => 'Balaluddin Mansion, Shenpara, Parbota, Section-10, Mirpur, Dhaka-1216, Bangladesh.',
            'shop_floor'  => 'Shop-06/07 (1st Floor)',
            'facebook'  => '#',
            'youtube'  => '#',
            'tiktok'  => '#',
            'instagram' => '#',
            'description' => 'N/A',
        ]);

        TermAndPrivacy::create([
            'term' => 'N/A',
            'privacy' => 'N/A',
        ]);


        category::create([
            'name' => 'unauthorized',
            'image' => 'default.jpg',
        ]);

        Brand::create([
            'name' => 'unauthorized',
            'image' => 'default.jpg',
        ]);

        Device::create([
            'name' => 'unauthorized',
            'image' => 'default.jpg',
        ]);

        ServiceType::create([
            'name' => 'unauthorized',
            'image' => 'default.jpg',
        ]);

        ExperienceVideo::create([
            'desp' => 'No Data Found',
            'link' => 'No Data Found',
        ]);

        Role::create(['name' => 'Super Admin','guard_name' => 'web']);
        User::find(1)->assignRole(1);
        $permissions = [
            'user_register',
            'user_edit',
            'user_delete',
            'user_view',
            'user_assign_role',
            'role_management',
            'dashboard_setting',
            'category_add',
            'category_edit',
            'category_delete',
            'subcategory_add',
            'subcategory_edit',
            'subcategory_delete',
            'tags_add',
            'tags_edit',
            'tags_delete',
            'blog_post',
            'blog_edit',
            'blog_delete',
            'blog_status_update',
            'gal_img_add',
            'gal_img_edit',
            'gal_img_delete',
            'gal_vdu_add',
            'gal_vdu_edit',
            'gal_vdu_delete',
            'repair_watch',
            'website_setting',
        ];

        foreach($permissions as $content)
        {
            $permission = Permission::create(['name' => $content]);
        }

    }
}
