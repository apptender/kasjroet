<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
      <div id="app" class="antialiased text-gray-900">
          <div>
              <div class="flex">
{{--                  <aside class="w-1/4 bg-gray-800 pt-8 min-h-screen">--}}
{{--                      <header class="p-6 mb-8">--}}
{{--                          <h1>NIK Kasjroetlijst</h1>--}}
{{--                      </header>--}}
{{--                      <section class="mb-10 pl-4">--}}
{{--                          <h5 class="text-gray-600 uppercase font-bold mb-4 text-base">Navigation</h5>--}}
{{--                          <ul class="text-gray-400 ">--}}
{{--                              <li class="text-sm hover:bg-gray-700 leading-large"><router-link  to="/" exact>Home</router-link></li>--}}
{{--                              <li class="text-sm hover:bg-gray-700 leading-large"><router-link  :to="{name: 'products'}">Producten</router-link></li>--}}
{{--                              <li class="text-sm hover:bg-gray-700 leading-large"><router-link  :to="{name: 'ingredients'}">Ingredi&euml;nten</router-link></li>--}}
{{--                              <li class="text-sm hover:bg-gray-700 leading-large"><router-link  :to="{name: 'categories'}">Categorie&euml;n</router-link></li>--}}
{{--                              <li class="text-sm hover:bg-gray-700  leading-large"><router-link  :to="{name: 'brands'}">Merken</router-link></li>--}}
{{--                          </ul>--}}
{{--                      </section>--}}
{{--                  </aside>--}}
                  <main class="primary w-3/4 flex-1 px-6 bg-gray-100">
                      <router-view></router-view>
                  </main>
              </div>
          </div>
      </div>
      <script src="/js/app.js"></script>
    </body>
</html>
