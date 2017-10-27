<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Territory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
       /* Blade::directive('activeTerr', function($beta){
            $territory = Territory::get();
           return "<?php if( $territory->active == 1): ?>"; 
        });
        Blade::directive('endactiveTerr', function($beta){
            return "<?php endif ?>"; 
         });*/
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
