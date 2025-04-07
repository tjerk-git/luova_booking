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
    
    // Handle mobile navigation
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mainNav = document.querySelector('.main-nav');
    
    if (mobileMenuButton && mainNav) {
        mobileMenuButton.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            mobileMenuButton.classList.toggle('active');
        });
        
        // Close menu when clicking on a link
        const navLinks = mainNav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                mainNav.classList.remove('active');
                mobileMenuButton.classList.remove('active');
            });
        });
    }
});