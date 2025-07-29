<?php

use App\Http\Controllers\AboutUsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogStatusController;
use App\Http\Controllers\userController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ExperienceVideoController;
use App\Http\Controllers\FAQsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceModuleController;
use App\Http\Controllers\SliderController;

// Website Routes ==============================================
Route::get('/', [FrontEndController::class, 'welcome'])->name('welcome');
Route::get('/about', [FrontEndController::class, 'about'])->name('about');
Route::get('/service/{device}', [FrontEndController::class, 'service_device'])->name('service_device');
Route::get('/product/{slug}', [FrontEndController::class, 'service_product'])->name('service_product');
Route::get('/blog/{slug}', [FrontEndController::class, 'blog_single'])->name('blog_single');
Route::get('/blogs', [FrontEndController::class, 'blog_list'])->name('list_blog');
Route::get('/category/{slug}', [FrontEndController::class, 'blog_category'])->name('blog_category');
Route::get('/terms-conditions', [FrontEndController::class, 'term'])->name('term');
Route::get('/privacy-policy', [FrontEndController::class, 'privacy'])->name('privacy');
Route::get('/search', [FrontEndController::class, 'search'])->name('search');
Route::get('/brand/{slug}', [FrontEndController::class, 'blogs'])->name('blogs');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('contact');

// Store Booking Data
Route::post('/admin/service/booking/store', [BookingController::class, 'store'])->name('booking.store');

// Guest url
Route::group(['middleware' => 'guest'], function () {
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('loginForm');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});


// Dashboard Routes ==============================================

// Dashboard Logout ==============================================
Route::get('/logout', [userController::class, 'logout'])->name('logout');
Auth::routes([
    'login'=> false,
]);

// Auth url
Route::group(['middleware' => 'auth'], function () {
    // admin dashboard
    Route::get('/admin', [HomeController::class, 'index'])->name('home');

    // User Routes
    Route::post('/admin/user/register', [userController::class, 'userRegister'])->name('userRegister');
    Route::get('/admin/user/list', [userController::class, 'userList'])->name('userList');
    Route::get('/admin/user/account/{user_id}', [userController::class, 'userAccount'])->name('userAccount');
    Route::post('/admin/user/account/updating/username', [userController::class, 'userUpdateUsername'])->name('userUpdateUsername');
    Route::post('/admin/user/account/updating/name', [userController::class, 'userUpdateName'])->name('userUpdateName');
    Route::post('/admin/user/account/updating/phone', [userController::class, 'userUpdatePhone'])->name('userUpdatePhone');
    Route::get('/admin/user/confirm/password/{user_id}{type}', [userController::class, 'userConfirmPassword'])->name('userConfirmPassword');
    Route::get('/admin/user/acount/change/details/{user_id}{type}', [userController::class, 'viewUserChangePassOrMail'])->name('viewUserChangePassOrMail');
    Route::post('/admin/user/account/password/confirm', [userController::class, 'userUpdatePassOrMail'])->name('userUpdatePassOrMail');
    Route::post('/admin/user/account/update/details', [userController::class, 'userChangePassOrMail'])->name('userChangePassOrMail');
    Route::get('/admin/user/photo/{id}', [userController::class, 'userPhoto'])->name('userPhoto');
    Route::post('/admin/user/update/photo', [userController::class, 'updateUserPhoto'])->name('updateUserPhoto');
    Route::get('/admin/user/delete/{id}', [userController::class, 'userDelete'])->name('userDelete');

    // Role Management
    // Route::get('/admin/Role/Management', [RoleManagemetController::class, 'roleManager'])->name('roleManager');
    // Route::get('/admin/Edit/{id}/Role/Permissions', [RoleManagemetController::class, 'editRolePermissions'])->name('editRolePermissions');
    // Route::post('/admin/store/permission', [RoleManagemetController::class, 'storePermission'])->name('storePermission');
    // Route::post('/admin/store/roles', [RoleManagemetController::class, 'storeRoleName'])->name('storeRoleName');
    // Route::post('/admin/assign/permission', [RoleManagemetController::class, 'assignPermToRole'])->name('assignPermToRole');
    // Route::post('/admin/update/assign/permission', [RoleManagemetController::class, 'UpdateAssignPermToRole'])->name('UpdateAssignPermToRole');
    // Route::post('/assign/role/to/user', [RoleManagemetController::class, 'assignRoleToUser'])->name('assignRoleToUser');

    // Company Profile
    Route::get('/admin/company/info', [CompanyProfileController::class, 'index'])->name('CompanyProfile.index');
    Route::post('/admin/company/update', [CompanyProfileController::class, 'update'])->name('CompanyProfile.update');

    // Company Profile
    Route::get('/admin/term_privacy', [CompanyProfileController::class, 'term_privacy_index'])->name('term_privacy.index');
    Route::post('/admin/term_privacy/update', [CompanyProfileController::class, 'term_privacy_update'])->name('term_privacy.update');

    // Booking List
    Route::get('/admin/service/booking/pending/lists', [BookingController::class, 'list'])->name('booking.list');
    Route::get('/admin/service/make/booking', [BookingController::class, 'makeBooking'])->name('booking.makeBooking');
    Route::get('/admin/service/booking/status/{id}/{type}', [BookingController::class, 'status'])->name('booking.status');
    // Store Url On Top

    // ========================================
    // Administrator
    // ========================================

    // AboutUs Profile
    Route::get('/admin/aboutus', [AboutUsController::class, 'index'])->name('aboutus.index');
    Route::post('/admin/aboutus/update', [AboutUsController::class, 'update'])->name('aboutus.update');

    // Slider Routes
    Route::get('/admin/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/admin/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::get('/admin/slider/{id}/delete', [SliderController::class, 'delete'])->name('slider.delete');
    Route::post('/admin/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::post('/admin/slider/update', [SliderController::class, 'update'])->name('slider.update');

    // Service Routes
    Route::get('/admin/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/admin/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::get('/admin/service/{id}/delete', [ServiceController::class, 'delete'])->name('service.delete');
    Route::post('/admin/service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::post('/admin/service/update', [ServiceController::class, 'update'])->name('service.update');

    // ExperienceVideo Routes
    Route::get('/admin/expvdu', [ExperienceVideoController::class, 'index'])->name('expvdu.index');
    Route::post('/admin/expvdu/update', [ExperienceVideoController::class, 'update'])->name('expvdu.update');

    // Review Routes
    Route::get('/admin/review', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/admin/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::get('/admin/review/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete');
    Route::post('/admin/review/store', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/admin/review/update', [ReviewController::class, 'update'])->name('review.update');

    // FAQs Routes
    Route::get('/admin/faq', [FAQsController::class, 'index'])->name('faq.index');
    Route::get('/admin/faq/{id}/edit', [FAQsController::class, 'edit'])->name('faq.edit');
    Route::get('/admin/faq/{id}/delete', [FAQsController::class, 'delete'])->name('faq.delete');
    Route::post('/admin/faq/store', [FAQsController::class, 'store'])->name('faq.store');
    Route::post('/admin/faq/update', [FAQsController::class, 'update'])->name('faq.update');

    // ========================================
    // Administrator
    // ========================================

    // ========================================
    // Service Module
    // ========================================

    Route::get('/admin/service/module/brand', [ServiceModuleController::class, 'index_brand'])->name('service.index.brand');
    Route::get('/admin/service/module/edit-brand/{id}', [ServiceModuleController::class, 'edit_brand'])->name('service.edit.brand');
    Route::post('/admin/service/module/store-brand', [ServiceModuleController::class, 'store_brand'])->name('service.store.brand');
    Route::post('/admin/service/module/update-brand', [ServiceModuleController::class, 'update_brand'])->name('service.update.brand');
    Route::get('/admin/service/module/delete-brand/{id}', [ServiceModuleController::class, 'delete_brand'])->name('service.delete.brand');

    Route::get('/admin/service/module/device', [ServiceModuleController::class, 'index_device'])->name('service.index.device');
    Route::get('/admin/service/module/edit-device/{id}', [ServiceModuleController::class, 'edit_device'])->name('service.edit.device');
    Route::post('/admin/service/module/store-device', [ServiceModuleController::class, 'store_device'])->name('service.store.device');
    Route::post('/admin/service/module/update-device', [ServiceModuleController::class, 'update_device'])->name('service.update.device');
    Route::get('/admin/service/module/delete-device/{id}', [ServiceModuleController::class, 'delete_device'])->name('service.delete.device');

    Route::get('/admin/service/module/type', [ServiceModuleController::class, 'index_type'])->name('service.index.type');
    Route::get('/admin/service/module/edit-type/{id}', [ServiceModuleController::class, 'edit_type'])->name('service.edit.type');
    Route::post('/admin/service/module/store-type', [ServiceModuleController::class, 'store_type'])->name('service.store.type');
    Route::post('/admin/service/module/update-type', [ServiceModuleController::class, 'update_type'])->name('service.update.type');
    Route::get('/admin/service/module/delete-type/{id}', [ServiceModuleController::class, 'delete_type'])->name('service.delete.type');


    Route::get('/admin/service/module/model', [ServiceModuleController::class, 'index_model'])->name('service.index.model');
    Route::get('/admin/service/module/edit-model/{id}', [ServiceModuleController::class, 'edit_model'])->name('service.edit.model');
    Route::post('/admin/service/module/store-model', [ServiceModuleController::class, 'store_model'])->name('service.store.model');
    Route::post('/admin/service/module/update-model', [ServiceModuleController::class, 'update_model'])->name('service.update.model');
    Route::get('/admin/service/module/delete-model/{id}', [ServiceModuleController::class, 'delete_model'])->name('service.delete.model');


    Route::get('/admin/service/module/product', [ServiceModuleController::class, 'index_product'])->name('service.index.product');
    Route::get('/admin/service/module/list-product', [ServiceModuleController::class, 'list_product'])->name('service.list.product');
    Route::get('/admin/service/module/edit-product/{id}', [ServiceModuleController::class, 'edit_product'])->name('service.edit.product');
    Route::post('/admin/service/module/store-product', [ServiceModuleController::class, 'store_product'])->name('service.store.product');
    Route::post('/admin/service/module/update-product', [ServiceModuleController::class, 'update_product'])->name('service.update.product');
    Route::get('/admin/service/module/delete-product/{id}', [ServiceModuleController::class, 'delete_product'])->name('service.delete.product');

    Route::get('/getModel', [ServiceModuleController::class, 'getModel'])->name('getModel'); // Ajax
    Route::get('/getProduct', [ServiceModuleController::class, 'getProduct'])->name('getProduct'); // Ajax

    // ========================================
    // Service Module
    // ========================================

    // ========================================
    // Blog Module
    // ========================================

    // Category Routes
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('categoryEntry');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('categoryStore');
    Route::get('/admin/category/{id}/Edit', [CategoryController::class, 'edit'])->name('categoryEdit');
    Route::post('/admin/category/update', [CategoryController::class, 'update'])->name('categoryUpdate');
    Route::get('/admin/category/{id}/trash', [CategoryController::class, 'trash'])->name('categorySoftDelete');

    // Post Blog Routes
    Route::get('/admin/blogs/post', [BlogPostController::class, 'index'])->name('blogEntry');
    Route::post('/admin/blogs/post/store', [BlogPostController::class, 'store'])->name('blogPostStore');
    Route::post('/admin/blogs/post/update', [BlogPostController::class, 'update'])->name('blogPostUpdate');
    Route::post('/admin/blogs/post/Image/update', [BlogPostController::class, 'blogImageUpdate'])->name('blogImageUpdate');
    Route::post('/getsubcategory', [BlogPostController::class, 'getsubcategory'])->name('getsubcategory');
    Route::get('/admin/blogs/post/records', [BlogPostController::class, 'records'])->name('blogRecords');
    Route::get('/admin/blogs/post/{id}/edit', [BlogPostController::class, 'edit'])->name('blogEdit');
    Route::get('/admin/blogs/post/{id}/delete', [BlogPostController::class, 'delete'])->name('blogSoftDelete');

    // Blog Status
    Route::get('/admins/blogs/schedule', [BlogStatusController::class, 'schedulePostList'])->name('schedulePostList');
    Route::get('/admins/blogs/drafts', [BlogStatusController::class, 'draftPostList'])->name('draftPostList');
    Route::post('/admins/blogs/update/status/to/schedule', [BlogStatusController::class, 'updatePostStatus'])->name('updatePostStatus');
    Route::get('/admins/blogs/update/to/publish/{id}', [BlogStatusController::class, 'updateBlogToPost'])->name('updateBlogToPost');
    Route::get('/admins/blogs/update/to/draft/{id}', [BlogStatusController::class, 'updateBlogToDraft'])->name('updateBlogToDraft');

    // ========================================
    // Blog Module
    // ========================================

});
