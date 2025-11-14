<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Agrowisata Dadi Raharja')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
</head>
<body>
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <!-- Scripts -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
    
    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }
        
        // Toggle dropdown on click
        function toggleDropdown(event) {
            event.preventDefault();
            event.stopPropagation();
            const dropdown = document.getElementById('cakupanDropdown');
            
            console.log('Dropdown clicked!', dropdown); // Debug log
            
            if (dropdown) {
                // Toggle the active class to expand/collapse
                const isActive = dropdown.classList.toggle('active');
                console.log('Dropdown active state:', isActive); // Debug log
            }
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('cakupanDropdown');
            if (dropdown && !dropdown.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });
        
        // Smooth scroll to top when clicking Beranda
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const berandaLinks = document.querySelectorAll('.nav-links a');
            
            berandaLinks.forEach(link => {
                if (link.textContent.trim() === 'Beranda') {
                    link.addEventListener('click', function(e) {
                        // Only apply smooth scroll if we're already on the home page
                        if (currentPath === '/' || currentPath === '') {
                            e.preventDefault();
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            // Close mobile menu if open
                            document.getElementById('navLinks').classList.remove('active');
                        }
                    });
                }
            });
        });
        
        // Close menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', (e) => {
                // Don't close if it's the dropdown trigger
                if (!e.target.onclick || e.target.onclick.toString().indexOf('toggleDropdown') === -1) {
                    const navLinks = document.getElementById('navLinks');
                    const dropdown = document.getElementById('cakupanDropdown');
                    
                    // Close the mobile menu
                    navLinks.classList.remove('active');
                    
                    // Also close the dropdown if open
                    if (dropdown) {
                        dropdown.classList.remove('active');
                    }
                }
            });
        });
        
        // Change navbar background on scroll
        function updateNavbarOnScroll() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
        
        // Check scroll position on page load
        window.addEventListener('DOMContentLoaded', updateNavbarOnScroll);
        
        // Check scroll position on scroll
        window.addEventListener('scroll', updateNavbarOnScroll);
    </script>
</body>
</html>
