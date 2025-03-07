const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');

window.Echo.private(`user.${userId}`)
    .listen('ReservationUpdated', (event) => {
        console.log('Réservation mise à jour :', event.reservation);

        // Afficher une notification dans l'interface
        const message = `Votre réservation #${event.reservation.id} a été mise à jour : ${event.reservation.status}`;
        alert(message);
    });
