<x-app-layout>
  <div class="container mx-auto p-4">
   
    <div class="bg-yellow-300 shadow-md rounded-lg p-6 mb-6 text-center">
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Bonjour, {{ Auth::user()->name }} !</h1>
      <p class="text-gray-700 italic">"Voyager, c'est la seule chose qu'on achète et qui nous rend plus riche."</p>
    </div>

    <!-- Tableau de bord principal -->
    <div class="bg-gray-100 shadow-md rounded-lg p-6 mb-6">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">Votre tableau de bord en tant que passager</h2>
      <p class="mb-4 text-gray-700">Accédez rapidement à vos fonctionnalités principales ci-dessous.</p>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="/passager/reservations" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded transition-transform transform hover:scale-105">
          Mes Réservations
        </a>
        <a href="/trajets" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded transition-transform transform hover:scale-105">
          Trajets Disponibles
        </a>
        <a href="" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition-transform transform hover:scale-105">
          Notifications
        </a>
        <a href="/profile" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded transition-transform transform hover:scale-105">
          Mon Profil
        </a>
      </div>
    </div>

    <!-- Aperçu des trajets disponibles -->
    <div class="bg-blue-100 shadow-md rounded-lg p-6 mb-6">
      <h2 class="text-2xl font-bold text-blue-800 mb-4">Trajets Disponibles</h2>
      <p class="text-gray-600 mb-4">Découvrez les trajets récemment ajoutés pour planifier votre prochaine aventure :</p>
      <ul class="space-y-2">
        <li class="bg-gray-100 shadow rounded p-4 flex justify-between items-center">
          <span class="text-gray-700">Casablanca → Rabat</span>
          <span class="text-sm text-gray-500">Départ : 10:00 AM</span>
          <button class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Réserver</button>
        </li>
        <li class="bg-gray-100 shadow rounded p-4 flex justify-between items-center">
          <span class="text-gray-700">Marrakech → Agadir</span>
          <span class="text-sm text-gray-500">Départ : 02:30 PM</span>
          <button class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Réserver</button>
        </li>
        <li class="bg-gray-100 shadow rounded p-4 flex justify-between items-center">
          <span class="text-gray-700">Fès → Tanger</span>
          <span class="text-sm text-gray-500">Départ : 06:00 PM</span>
          <button class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Réserver</button>
        </li>
      </ul>
    </div>
          @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

      @if(session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
    <!-- Section Notifications -->
    <div class="bg-gray-200 shadow-md rounded-lg p-6 mb-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Dernières Notifications</h2>
      <ul class="space-y-2">
        <li class="bg-white shadow rounded p-4">
          <p class="text-gray-700">Votre réservation pour le trajet Casablanca → Rabat a été confirmée.</p>
          <span class="text-sm text-gray-500">Il y a 1 heure</span>
        </li>
        <li class="bg-white shadow rounded p-4">
          <p class="text-gray-700">Nouvelle annonce : Marrakech → Agadir à 14:30 aujourd'hui.</p>
          <span class="text-sm text-gray-500">Il y a 3 heures</span>
        </li>
        <li class="bg-white shadow rounded p-4">
          <p class="text-gray-700">Mise à jour : Votre trajet Fès → Tanger est reporté à 18:00.</p>
          <span class="text-sm text-gray-500">Il y a 5 heures</span>
        </li>
      </ul>
    </div>

    <!-- Section de Contact -->
    <div class="bg-gray-50 shadow-md rounded-lg p-6 text-center">
      <h2 class="text-2xl font-bold text-gray-700 mb-4">Besoin d'aide ?</h2>
      <p class="text-gray-600 mb-4">Notre équipe est disponible 24/7 pour répondre à vos questions.</p>
      <a href="mailto:support@grandtaxigo.com" class="bg-blue-700 hover:bg-blue-800 text-white py-2 px-4 rounded inline-block">
        Contacter le Support
      </a>
    </div>
  </div>
</x-app-layout>
