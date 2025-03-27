document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');


    // Update end date min value when start date changes
    startDateInput.addEventListener('change', function() {
        endDateInput.min = startDateInput.value;
        if (endDateInput.value && endDateInput.value < startDateInput.value) {
            endDateInput.value = startDateInput.value;
        }
    });

    // Show options button handler
    const showOptionsButton = document.getElementById('options-button');
    if (showOptionsButton) {
        showOptionsButton.addEventListener('click', function() {
            const bookingForm = document.getElementById('booking');
            bookingForm.scrollIntoView({ behavior: 'smooth' });
        });
    }

    // Check if success message is present and trigger confetti
    const successMessage = document.querySelector('.alert-success');
    if (successMessage && typeof confetti === 'function') {
        const colors = ['rgb(181, 73, 34)', '#fbbf24', '#f97316'];
        
        // Initial burst
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 },
            colors: colors
        });

        // Delayed side bursts
        setTimeout(() => {
            // Left burst
            confetti({
                particleCount: 50,
                angle: 60,
                spread: 55,
                origin: { x: 0, y: 0.6 },
                colors: colors
            });

            // Right burst
            confetti({
                particleCount: 50,
                angle: 120,
                spread: 55,
                origin: { x: 1, y: 0.6 },
                colors: colors
            });
        }, 250);

        // Final sprinkle
        setTimeout(() => {
            confetti({
                particleCount: 75,
                angle: 90,
                spread: 100,
                origin: { x: 0.5, y: 0.6 },
                colors: colors,
                ticks: 200
            });
        }, 500);
    }

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const menuLinks = mainNav.querySelectorAll('a');
    const body = document.body;

    function toggleMenu() {
        menuToggle.classList.toggle('active');
        mainNav.classList.toggle('active');
        body.classList.toggle('menu-open');
        
        // Toggle menu icon animation
        const spans = menuToggle.querySelectorAll('span');
        if (menuToggle.classList.contains('active')) {
            spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
            spans[1].style.opacity = '0';
            spans[2].style.transform = 'rotate(-45deg) translate(7px, -7px)';
        } else {
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        }
    }

    menuToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleMenu();
    });

    // Close menu when clicking a link
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (mainNav.classList.contains('active')) {
                toggleMenu();
            }
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!menuToggle.contains(e.target) && 
            !mainNav.contains(e.target) && 
            mainNav.classList.contains('active')) {
            toggleMenu();
        }
    });

    // Close menu on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mainNav.classList.contains('active')) {
            toggleMenu();
        }
    });

    // Header scroll effect
    const header = document.querySelector('header');
    let lastScroll = 0;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });
});