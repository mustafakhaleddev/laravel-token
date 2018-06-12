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
        if (! defined("DT_STARTED")) {
            /** @deprecated  */
            define('DT_STARTED', true);
            /** @deprecated  */
            define('DT_Unique', 'Unique');
            /** @deprecated  */
            define('DT_UniqueNum', 'UniqueNumber');
            /** @deprecated  */
            define('DT_UniqueStr', 'UniqueString');
            /** @deprecated  */
            define('DT_Random', 'Random');
            /** @deprecated  */
            define('DT_RandomNum', 'RandomNumber');
            /** @deprecated  */
            define('DT_RandomStr', 'RandomString');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Token', function () {
            return new Token;
        });
    }
}
