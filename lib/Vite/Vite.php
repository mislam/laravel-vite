<?php

namespace Lib\Vite;

use Illuminate\Support\Facades\App;

class Vite
{
   private $manifestCache = null;

   public function embed(string $entry): string
   {
      return $this->jsImports($entry) . $this->jsPreloadImports($entry) . $this->cssImports($entry);
   }

   public function favicons(): string
   {
      $appName = config('app.name', 'Laravel');
      $urls = [];
      $entries = [
         'apple-touch-icon-png' => 'apple-touch-icon.png',
         'favicon-32x32-png' => 'favicon-32x32.png',
         'favicon-16x16-png' => 'favicon-16x16.png',
         'site-webmanifest' => 'site.webmanifest',
         'safari-pinned-tab-svg' => 'safari-pinned-tab.svg',
         'favicon-ico' => 'favicon.ico',
         'browserconfig-xml' => 'browserconfig.xml',
      ];
      foreach ($entries as $entry => $file) {
         $urls[$entry] = App::environment('local')
            ? $this->localAsset("favicon/{$file}")
            : $this->productionAsset($entry);
      }
      return '' .
         "<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"{$urls['apple-touch-icon-png']}\">" .
         "<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"{$urls['favicon-32x32-png']}\">" .
         "<link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"{$urls['favicon-16x16-png']}\">" .
         "<link rel=\"manifest\" href=\"{$urls['site-webmanifest']}\">" .
         "<link rel=\"mask-icon\" href=\"{$urls['safari-pinned-tab-svg']}\" color=\"#0099ff\">" .
         "<link rel=\"shortcut icon\" href=\"{$urls['favicon-ico']}\">" .
         "<meta name=\"apple-mobile-web-app-title\" content=\"{$appName}\">" .
         "<meta name=\"application-name\" content=\"{$appName}\">" .
         "<meta name=\"msapplication-TileColor\" content=\"#0099ff\">" .
         "<meta name=\"msapplication-config\" content=\"{$urls['browserconfig-xml']}\">" .
         "<meta name=\"theme-color\" content=\"#ffffff\">";
   }

   private function getManifest(): array
   {
      if ($this->manifestCache) {
         return $this->manifestCache;
      }

      $content = file_get_contents(public_path('dist/manifest.json'));
      $this->manifestCache = json_decode($content, true);

      return $this->manifestCache;
   }

   private function jsImports(string $entry): string
   {
      $url = App::environment('local') ? $this->localAsset($entry) : $this->productionAsset($entry);

      if (!$url) {
         return '';
      }
      return "<script type=\"module\" src=\"$url\"></script>";
   }

   private function jsPreloadImports(string $entry): string
   {
      if (App::environment('local')) {
         return '';
      }

      $res = '';
      foreach ($this->preloadUrls($entry) as $url) {
         $res .= "<link rel=\"modulepreload\" href=\"$url\">";
      }
      return $res;
   }

   private function preloadUrls(string $entry): array
   {
      $urls = [];
      $manifest = $this->getManifest();

      if (!empty($manifest[$entry]['imports'])) {
         foreach ($manifest[$entry]['imports'] as $imports) {
            $urls[] = asset('/dist/' . $manifest[$imports]['file']);
         }
      }
      return $urls;
   }

   private function cssImports(string $entry): string
   {
      // not needed on dev, it's inject by Vite
      if (App::environment('local')) {
         return '';
      }

      $tags = '';
      foreach ($this->cssUrls($entry) as $url) {
         $tags .= "<link rel=\"stylesheet\" href=\"$url\">";
      }
      return $tags;
   }

   private function cssUrls(string $entry): array
   {
      $urls = [];
      $manifest = $this->getManifest();

      if (!empty($manifest[$entry]['css'])) {
         foreach ($manifest[$entry]['css'] as $file) {
            $urls[] = asset('/dist/' . $file);
         }
      }
      return $urls;
   }

   private function localAsset(string $entry): string
   {
      return asset($entry);
   }

   private function productionAsset(string $entry): string
   {
      $manifest = $this->getManifest();

      if (!isset($manifest[$entry])) {
         return '';
      }

      return asset('/dist/' . $manifest[$entry]['file']);
   }
}
