<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminlteServicePovider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            //ASSETS
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\dist' => public_path('/adminlte/dist'),

            //PLUGINS
            //  - colorpicker
            // __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\bootstrap-colorpicker' => public_path('\adminlte\plugins\bootstrap-colorpicker'),
            //  - datatables
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\datatables' => public_path('\adminlte\plugins\datatables'),
            //  - fontawesome-free
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\fontawesome-free' => public_path('\adminlte\plugins\fontawesome-free'),
            //  - jquery
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\jquery' => public_path('\adminlte\plugins\jquery'),


        ]);
    }
}
