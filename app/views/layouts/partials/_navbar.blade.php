<nav class="menu">
    <ul>
      
        <li class="{{ set_active('/') }}"><a href="/">Inicio</a></li>
        @foreach ($menu as $item)
        	@if($item->slug == "accesorios")
        		<li class="{{ set_active('categories/'.$item->slug) }} parent"><a href="/categories/{{ $item->slug }}/products">{{ $item->name }}</a>
                   
                    <ul class="sub-menu">
                      @foreach ($item->getDescendants() as $submenu)
                        <li class="{{ set_active('categories/'.$submenu->slug) }}"><a href="/categories/{{ $submenu->slug }}/products">{{ $submenu->name }}</a></li>
                      @endforeach 
                    </ul>
                   
                </li>
                
        	@else
        		<li class="{{ set_active('categories/'.$item->slug) }} parent"><a href="/categories/{{ $item->slug }}">{{ $item->name }}</a>
                    
                    <ul class="sub-menu">
                      @foreach ($item->getDescendants() as $submenu)
                        <li class="{{ set_active('categories/'.$submenu->slug) }}"><a href="/categories/{{ $submenu->slug }}/products">{{ $submenu->name }}</a></li>
                      @endforeach 
                    </ul>
                   
                </li>
                
        	@endif
        @endforeach
        <li class="{{ set_active('location') }}"><a href="/location">Ubicación</a></li>
        <li class="{{ set_active('contact') }}"><a href="/contact">Contáctenos</a></li>
       
    </ul>
    
</nav>
