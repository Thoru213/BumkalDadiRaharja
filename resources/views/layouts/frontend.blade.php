<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Agrowisata Dadi Raharja')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
</head>
<body>
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
    
    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        function toggleDropdown(event) {
            event.preventDefault();
            event.stopPropagation();
            const dropdown = document.getElementById('cakupanDropdown');
            
            console.log('Dropdown clicked!', dropdown);
            
            if (dropdown) {
                const isActive = dropdown.classList.toggle('active');
                console.log('Dropdown active state:', isActive);
            }
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('cakupanDropdown');
            if (dropdown && !dropdown.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const berandaLinks = document.querySelectorAll('.nav-links a');
            
            berandaLinks.forEach(link => {
                if (link.textContent.trim() === 'Beranda') {
                    link.addEventListener('click', function(e) {
                        if (currentPath === '/' || currentPath === '') {
                            e.preventDefault();
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            document.getElementById('navLinks').classList.remove('active');
                        }
                    });
                }
            });
        });

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', (e) => {
                if (!e.target.onclick || e.target.onclick.toString().indexOf('toggleDropdown') === -1) {
                    const navLinks = document.getElementById('navLinks');
                    const dropdown = document.getElementById('cakupanDropdown');

                    navLinks.classList.remove('active');

                    if (dropdown) {
                        dropdown.classList.remove('active');
                    }
                }
            });
        });

        function updateNavbarOnScroll() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }

        window.addEventListener('DOMContentLoaded', updateNavbarOnScroll);

        window.addEventListener('scroll', updateNavbarOnScroll);
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            const fadeElements = document.querySelectorAll('.fade-in-up');
            fadeElements.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
