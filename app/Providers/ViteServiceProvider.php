<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

class ViteServiceProvider extends ServiceProvider
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
      /**
       * In the local dev environment, load all image assets from Vite's dev server.
       * Don't worry about production, Vite's build script takes care of that!
       */
      if (App::environment('local')) {
         Route::get('/img/{file}', function ($file) {
            return response()->redirectTo('http://localhost:3000/img/' . $file, 302);
         });
      }
   }
}
