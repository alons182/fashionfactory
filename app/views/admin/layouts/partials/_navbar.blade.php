 
 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/admin">Fashion Factory</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="{{ set_active('admin') }}"><a href="/admin">Home</a></li>
           @if (! Auth::guest())
            <li class="{{ set_active('admin/users') }}"><a href="/admin/users">Users</a></li>
            <li class="{{ set_active('admin/categories') }}"><a href="/admin/categories">Categories</a></li>
            <li class="{{ set_active('admin/products') }}"><a href="/admin/products">Products</a></li>
            <li><a href="/admin/logout">Logout</a></li>
           @else 
              <li class="{{ set_active('admin/login') }}"><a href="/admin/login">Login</a></li>
              
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
