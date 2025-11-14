<header class="{{ request()->routeIs('home') ? 'transparent-nav' : 'solid-nav' }}">
    <nav class="navbar">
        <div class="logo">
            <span style="color: white; font-weight: 700; letter-spacing: 0.5px; font-size: 1.7em;">BUMKAL</span><br>
            <span class="logo-subtitle" style="font-weight: 700; font-size: 1.8em; letter-spacing: -0.5px;">Dadi Raharja</span>
        </div>
        <div class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('home') }}#tentang">Tentang Kami</a></li>
            
            <li class="dropdown" id="cakupanDropdown">
                <a href="javascript:void(0)" onclick="toggleDropdown(event)">Cakupan ▾</a>
                <div class="dropdown-content">
                    <a href="{{ route('cakupan.show', 'pertanian') }}">Pertanian, Perkebunan, Peternakan & Perikanan</a>
                    <a href="{{ route('cakupan.show', 'pariwisata') }}">Pariwisata</a>
                    <a href="{{ route('cakupan.show', 'umkm') }}">UMKM</a>
                </div>
            </li>
            
            <li><a href="{{ route('home') }}#galeri">Galeri</a></li>
            <li><a href="{{ route('home') }}#kontak">Kontak</a></li>
            
            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            @endauth
        </ul>
    </nav>
</header>
