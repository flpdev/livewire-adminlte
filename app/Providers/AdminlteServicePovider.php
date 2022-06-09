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
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\datatables-bs4' => public_path('\adminlte\plugins\datatables-bs4'),
            //  - datatables
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\datatables' => public_path('\adminlte\plugins\datatables'),
            //  - fontawesome-free
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\fontawesome-free' => public_path('\adminlte\plugins\fontawesome-free'),
            //  - jquery
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\jquery' => public_path('\adminlte\plugins\jquery'),
            //  - icheck-bootstrap
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\icheck-bootstrap' => public_path('\adminlte\plugins\icheck-bootstrap'),
            //  - inputmask
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\inputmask' => public_path('\adminlte\plugins\inputmask'),
            //  - select2
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\select2' => public_path('\adminlte\plugins\select2'),
            //  - bootstrap
            __DIR__.'\..\..\vendor\almasaeed2010\adminlte\plugins\bootstrap' => public_path('\adminlte\plugins\bootstrap'),


        ]);
    }
}
