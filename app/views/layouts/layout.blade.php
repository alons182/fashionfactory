<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        
        <title>@yield('meta-title','Fashion Factory | Inicio')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico">
        <link href="//fonts.googleapis.com/css?family=Lato:100,300,700" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="/css/bundle.css">
        <script src="/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
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

                    <div class="redes">
                        <a href="#" class="icon icon-facebook" title="Facebook"></a>
                        <a href="#" class="icon icon-twitter" title="Twitter"></a>
                        <a href="#" class="icon icon-libermall" title="Libermall"></a>
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
           /* (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');*/
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

