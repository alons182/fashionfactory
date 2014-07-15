<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        
        <title>@yield('meta-title','Fashion Factory | Inicio')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/favicon.ico">
        <link href="//fonts.googleapis.com/css?family=Lato:100,300,700" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="/css/bundle.css">
        <script src="/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <div class="loading-container">
            <div class="loading">
                <img src="/img/loading-site.gif" alt="Cargando">
            </div>
        </div>
        <header class="fixed">
            <div class="container">
                 <a href="#" class="search"><span class="icon-search"></span></a>
                 {{ Form::open(['url' => 'search','method' => 'get','class'=>'form-search']) }}
                       <div class="search-container">
                                             
                        {{ Form::text('q',null,['class'=>'form-control','placeholder'=>'Buscar'])}}
                       
                        </div>

                 {{ Form::close() }}   
                 
                 <div id="btn_mobile"><span class="icon-menu"></span></div>
            </div>
           
        </header>
        <section class="wrapper">
            <div class="container">
                <aside class="section-left">
                    
                    <a href="/" class="logo"><img src="/img/logo.svg" alt="Fashion Factory" /></a>
                
                    @include('layouts/partials/_navbar')
                    
                    <a href="http://fashionfactorycr.us2.list-manage.com/subscribe?u=595e4e5f9adffbd2554f75cab&id=b82738cee4" class="btn btn-descuento" target="_blank">Recibí descuentos</a>
                    <div class="redes">
                        <a href="https://www.facebook.com/fashionfactorylib" class="icon icon-facebook" title="Facebook" target="_blank"></a>
                        <!--<a href="#" class="icon icon-twitter" title="Twitter"></a>-->
                        <a href="http://www.libermall.com" class="icon icon-libermall" title="Libermall" target="_blank"></a>
                    </div>

                    <div class="copyright">
                        <a href="http://www.avotz.com" title="Avotz Webworks" target="_blank"><span class="icon-avotz"></span></a>
                        <span>Copyright &copy; 2014</span>
                    </div>
                    
                    
                </aside>
                <section class="main">
                
                    @yield('content')
                                  
                </section>
            </div>
        </section>


        <script src="/js/bundle.js"></script>
        @yield('scripts')
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
           //$('.carousel').swipe();
          
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-21485543-10', 'auto');
          ga('send', 'pageview');

        </script>
        <!-- CaptainUP App -->
        <div id='cptup-ready'></div>
        <script data-cfasync='false' type='text/javascript'>
            window.captain = {up: function(fn) { captain.topics.push(fn) }, topics: []};
            /* Add your settings here: */
            captain.up({
                api_key: '53b1bbe273873a8d24000002'
            });
        </script>
        <script data-cfasync='false' type='text/javascript'>
            (function() {
                var cpt = document.createElement('script'); cpt.type = 'text/javascript'; cpt.async = true;
                cpt.src = 'http' + (location.protocol == 'https:' ? 's' : '') + '://captainup.com/assets/embed.es.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(cpt);
            })();
        </script>
    </body>
</html>

