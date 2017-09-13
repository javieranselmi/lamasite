<?php

namespace App\Providers;

use App\Jobs\SendContentNotificationEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'layouts.footer', 'App\Http\ViewComposers\FooterComposer'
        );
        View::composer(
            '*', 'App\Http\ViewComposers\TextAllViewsComposer'
        );
        Validator::extend('unique_folder_name', function ($attribute, $value, $parameters, $validator) {
            return \App\Folder::where(['folder_name' => str_slug($value, "_")])->get()->count() == 0;
        });
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
