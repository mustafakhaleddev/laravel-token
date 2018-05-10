<?php

namespace Dirape\Token;

use Illuminate\Support\ServiceProvider;

class TokenServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        define('DT_Unique',  'Unique');
        define('DT_UniqueNum',  'UniqueNumber');
        define('DT_UniqueStr',  'UniqueString');
        define('DT_Random',  'Random');
        define('DT_RandomNum',  'RandomNumber');
        define('DT_RandomStr',  'RandomString');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
            $this->app->bind('Token',function(){
            return new Token;
        });
    }
}
