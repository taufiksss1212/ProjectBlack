document.addEventListener("DOMContentLoaded", function() {
    // Init AOS
    AOS.init({ once: true, offset: 100, duration: 800 });

    // Navbar Scroll Change Color
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            const toggler = document.querySelector('.navbar-collapse');
            if (!toggler.classList.contains('show')) {
                navbar.classList.remove('scrolled');
            }
        }
    });

    // Close Hamburger Menu on Scroll
    window.addEventListener('scroll', function() {
        const navbarCollapse = document.querySelector('.navbar-collapse');
        if (navbarCollapse && navbarCollapse.classList.contains('show')) {
            const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: false });
            bsCollapse.hide();
        }
    });

    // Scroll Progress
    window.onscroll = function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        const progressBar = document.getElementById("scrollProgress");
        if(progressBar) progressBar.style.width = scrolled + "%";
    };

    // Preloader Logic
    function hidePreloader() {
        const preloader = document.getElementById('preloader');
        if (preloader && preloader.style.display !== 'none') {
            preloader.style.opacity = '0';
            setTimeout(() => { preloader.style.display = 'none'; }, 400);
        }
    }
    window.addEventListener("load", hidePreloader);
    setTimeout(hidePreloader, 1200);

    // Custom Cursor (Desktop Only)
    if (window.matchMedia("(min-width: 992px)").matches) {
        const cursorDot = document.querySelector("[data-cursor-dot]");
        const cursorOutline = document.querySelector("[data-cursor-outline]");
        if(cursorDot && cursorOutline) {
            window.addEventListener("mousemove", function(e) {
                const posX = e.clientX;
                const posY = e.clientY;
                cursorDot.style.left = `${posX}px`;
                cursorDot.style.top = `${posY}px`;
                cursorOutline.animate({ left: `${posX}px`, top: `${posY}px` }, { duration: 500, fill: "forwards" });
            });
            const interactiveElements = document.querySelectorAll('a, button, .btn, .card, .contact-card, input');
            interactiveElements.forEach(el => {
                el.addEventListener('mouseenter', () => document.body.classList.add('hovering'));
                el.addEventListener('mouseleave', () => document.body.classList.remove('hovering'));
            });
        }
    }
});

