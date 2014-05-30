
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>@yield('meta-title','Fashion Factory | Administration')</title>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/lightbox.css">
    <link rel="stylesheet" href="/css/admin.css">

    
  </head>

  <body>

   @include('admin/layouts/partials/_navbar')
   
    <div class="container">
      @include('admin/layouts/partials/_flash_message')
      @yield('content')

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
     <script src="/js/vendor/lightbox.min.js"></script>
     <script src="/js/vendor/handlebars-v1.3.0.js"></script>
     
    <script src="/js/vendor/ajaxupload.js"></script>

    <script src="/js/admin.js"></script>
  </body>
</html>
