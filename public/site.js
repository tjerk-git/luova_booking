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
    const showOptionsButton = document.getElementById('showOptions');
    if (showOptionsButton) {
        showOptionsButton.addEventListener('click', function() {
            const bookingForm = document.getElementById('bookingForm');
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
});