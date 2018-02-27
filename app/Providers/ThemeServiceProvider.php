<?php


namespace App\Providers;

use App\Classes\Theme;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
       $theme_path = base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.config('theme.name','default');

       if (!is_dir($theme_path)){
           throw new \Exception('Theme doesn\'t exists');
       }

       $this->app->singleton('theme',function($app) {
           return new Theme(config('theme.name','default'));
       });
    }

    /**
     *
     */
    public function register()
    {
        
    }

}