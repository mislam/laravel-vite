<?php

namespace Lib\Vite;

use Illuminate\Support\Facades\Facade;

class ViteFacade extends Facade
{
   /**
    * Get the registered name of the component.
    *
    * @return string
    */
   protected static function getFacadeAccessor()
   {
      return 'vite';
   }
}
