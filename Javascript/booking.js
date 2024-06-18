function showGrounds(category) {
    const groundSelection = document.getElementById('groundSelection');
    const privateCoachingSelection = document.getElementById('privateCoachingSelection');

    // Change the header based on the category
    const header = document.getElementById('groundHeader');
    if (category === 'GroundBooking') {
        header.textContent = 'Available Grounds for Ground Booking';
        groundSelection.style.display = 'block';
        privateCoachingSelection.style.display = 'none'; // Hide private coaching section
    } else if (category === 'PrivateCoaching') {
        header.textContent = 'Private Coaching Available Soon...';
        groundSelection.style.display = 'none'; // Hide ground selection
        privateCoachingSelection.style.display = 'block';
    }
} 