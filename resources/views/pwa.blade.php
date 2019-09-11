<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-139719882-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-139719882-2');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Een database met koosjere producten in Nederland">
    <meta name="keywords" content="koosjer, is het koosjer, ishetkoosjer, kosher, is het kosher">
    <meta property="og:title" content="Is het Koosjer">
    <meta property="og:description" content="Een database met koosjere producten in Nederland">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Is het Koosjer?</title>
    <link rel="stylesheet" href="/css/app.css">
    @laravelPWA
</head>

<body>
    <div id="app" class="antialiased text-gray-900">
        <div>
            <div id="apple-install">
                <div class="bg-white flex items-center justify-center">
                    <div>
                        <p class="text-2xl text-gray-800 font-bold text-center">Install Is het Koosjer</p>
                        <p class="text-center">Installeer deze applicatie op je homescreen. Hiermee heb je makkelijk toegang tot de meest actuele kasjroetlijst</p>
                    </div>

                </div>
                <div class="bg-gray-200">
                    <p class="text-center">Druk op het share Icoon en druk dan op: Toevoegen aan homescreen</p>
                </div>
            </div>
            <div class="hidden" id="install">
                <div class="bg-indigo-900 sm:text-center px-4 py-4">
                    <div class="p-2 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex lg:flex-row flex-col"
                         role="alert">
                        <p class="font-bold block leading-relaxed">Download onze app!</p>
                        <p class="font-semibold mr-2 text-left flex-auto text-sm ml-1 block leading-relaxed">
                            Het neemt
                            <underline>geen</underline>
                            ruimte in op uw apparaat<!doctype html>
                        </p>
                        <button class="flex py-2 my-1 px-4 rounded-full bg-indigo-500 font-bold ml-3 hover:bg-indigo-400 cursor-pointer"
                                id="install-now">
                            Installeer
                        </button>
                        <p class="text-indigo-300 underline cursor-pointer hover:text-indigo-200 block leading-relaxed sm:ml-4" id="dismiss">Niet
                            nu</p>
                    </div>
                </div>
            </div>
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
    <script type="text/javascript">
      window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        let deferredPrompt = e;

        if (['iPhone', 'iPad', 'iPod' ].includes(navigator.platform) === true && !navigator.standalone) {
          document.getElementById('install').classList.add('hidden');
        }


        document.getElementById('install-now').addEventListener('click', () => {
          document.getElementById('install').classList.add('hidden');

          deferredPrompt.prompt();
          deferredPrompt.userChoice.then((choiceResult) => {
            deferredPrompt = null;
          })
        });

        document.getElementById('dismiss').addEventListener('click', () => {
          document.getElementById('install').classList.add('hidden');
        });

        showInstall();
      });

      function showInstall() {
        document.getElementById('install').classList.remove('hidden');
      }
    </script>
    <script src="/js/app.js"></script>
</body>

</html>
