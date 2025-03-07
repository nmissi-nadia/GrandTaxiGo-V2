import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Configuration de Pusher
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    disableStats: true,
});

// Exemple d'écoute des notifications pour un utilisateur
// Remplacez 'userId' par l'ID de l'utilisateur authentifié
const userId = window.Laravel.user.id; // Assurez-vous que cette variable existe dans votre layout Blade
window.Echo.private(`user.${userId}`)
    .listen('ReservationUpdated', (e) => {
        console.log('Réservation mise à jour : ', e);
        // Mettre à jour l'interface utilisateur ou afficher une notification
    });
    import Echo from "laravel-echo";
    window.Pusher = require("pusher-js");
    
    window.Echo = new Echo({
        broadcaster: "pusher",
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        forceTLS: true,
    });
    