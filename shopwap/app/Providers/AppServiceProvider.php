<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        #前台
        //header组件
       Blade::component('layout.header','header');
        //footer组件
        Blade::component('layout.footer','footer');

        #后台
        //top 组件
        blade::component('home.layout.top','top');
        //left 组件
        blade::component('home.layout.left','left');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
