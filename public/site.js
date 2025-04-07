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
    
    // Initialize Micromodal
    if (typeof MicroModal !== 'undefined') {
        MicroModal.init({
            openTrigger: 'data-micromodal-trigger',
            closeTrigger: 'data-micromodal-close',
            disableFocus: false,
            disableScroll: true,
            awaitOpenAnimation: true,
            awaitCloseAnimation: true
        });
    }
    
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const body = document.body;
    
    if (menuToggle && mainNav) {
        function toggleMenu() {
            menuToggle.classList.toggle('active');
            mainNav.classList.toggle('active');
            body.classList.toggle('menu-open');
        }
        
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMenu();
        });
        
        // Close menu when clicking on a link
        const navLinks = mainNav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (mainNav.classList.contains('active')) {
                    toggleMenu();
                }
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && 
                !mainNav.contains(e.target) && 
                mainNav.classList.contains('active')) {
                toggleMenu();
            }
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mainNav.classList.contains('active')) {
                toggleMenu();
            }
        });
    }
    
    // Header scroll effect
    const header = document.querySelector('header');
    
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
});