<nav class="menu">
    <ul>
      
        <li class="{{ set_active('/') }}"><a href="/">Inicio</a></li>
        @foreach ($menu as $item)
        	<li class="{{ set_active('categories/'.$item->slug) }}"><a href="/categories/{{ $item->slug }}">{{ $item->name }}</a></li>
        @endforeach
        <li class="{{ set_active('about') }}"><a href="/about">Acerca de</a></li>
        <li class="{{ set_active('contact') }}"><a href="/contact">Contáctenos</a></li>
       
    </ul>
    
</nav>
