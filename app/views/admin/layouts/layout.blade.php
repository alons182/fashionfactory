
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>@yield('meta-title','Fashion Factory | Administration')</title>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bundle_admin.css">

    
  </head>

  <body>

   @include('admin/layouts/partials/_navbar')
   
    <div class="container">
      @include('admin/layouts/partials/_flash_message')
      @yield('content')

    </div>

    
     <script src="/js/bundle_admin.js"></script>
     <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </body>
</html>
