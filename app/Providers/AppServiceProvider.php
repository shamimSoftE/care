<?php

namespace App\Providers;

use App\Models\CompanyInfo;
use App\Models\Device;
use App\Models\Slider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $companyInfo = CompanyInfo::first();
        $slider      = Slider::all();
        $device      = Device::where('id','!=',1)->get();

        view()->share([
            'companyInfo' => $companyInfo,
            'device'      => $device,
            'slider'      => $slider,
        ]);
        Paginator::useBootstrap();
    }
}
