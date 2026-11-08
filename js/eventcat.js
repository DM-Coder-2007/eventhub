function filterEvents(event, categorySlug) {
    event.preventDefault();

    // Grab all the dynamic event cards on the page
    const allCards = document.querySelectorAll('.dynamic-card');

    // Loop through every card and check its classes
    allCards.forEach(card => {
        if (categorySlug === 'all') {
            // If they clicked "All", show everything
            card.style.display = "flex";
        } else {
            // If the card has the matching class (e.g., 'tech'), show it. If not, hide it.
            if (card.classList.contains(categorySlug)) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        }
    });
}