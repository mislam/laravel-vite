<?php

namespace Lib\Vite;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
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
      $this->app->singleton('vite', function () {
         return new Vite();
      });
   }

   /**
    * Bootstrap services.
    *
    * @return void
    */
   public function boot()
   {
      Blade::directive('favicons', function () {
         return ViteFacade::favicons();
      });

      Blade::directive('vite', function ($entry) {
         if (empty($entry)) {
            $entry = 'js/app.js';
         }
         return ViteFacade::embed($entry);
      });

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
