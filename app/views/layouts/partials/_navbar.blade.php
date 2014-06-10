<nav class="menu">
    <ul>
      
        <li class="{{ set_active('/') }}"><a href="/">Inicio</a></li>
        @foreach ($menu as $item)
        	@if($item->slug == "accesorios")
        		<li class="{{ set_active('categories/'.$item->slug) }}"><a href="/categories/{{ $item->slug }}/products">{{ $item->name }}</a></li>
        	@else
        		<li class="{{ set_active('categories/'.$item->slug) }}"><a href="/categories/{{ $item->slug }}">{{ $item->name }}</a></li>
        	@endif
        @endforeach
        <li class="{{ set_active('about') }}"><a href="/about">Acerca de</a></li>
        <li class="{{ set_active('contact') }}"><a href="/contact">Contáctenos</a></li>
       
    </ul>
    
</nav>
