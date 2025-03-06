<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <!-- Inclure Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4a77c5', // Bleu
                        secondary: '#282c34', // Noir foncé
                        tertiary: '#f9d71c', // Jaune
                        grayLight: '#e5e7de', // Gris clair
                        grayDark: '#4b5563', // Gris foncé
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-grayLight font-sans text-grayDark">

    <!-- Header -->
    <header class="bg-yellow-500 py-4 px-6 flex justify-between items-center shadow-md">
        <h1 class="text-xl mx-10 font-semibold text-white">Tableau de Bord M.</h1>
        <div class="flex space-x-4">
            <a href="/profile" class="text-white hover:text-tertiary transition duration-300">Profil</a>
            <a href="/logout" class="text-white hover:text-danger transition duration-300">Déconnexion</a>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-500 h-screen fixed top-0 left-0 py-6 px-4 overflow-y-auto">
        <ul class="space-y-2">
            <li>
                <a href="#users" class="block py-2 px-4 rounded-md text-white hover:bg-primary transition duration-300">Gestion des Utilisateurs</a>
            </li>
            <li>
                <a href="#villes" class="block py-2 px-4 rounded-md text-white hover:bg-primary transition duration-300">Gestion des Villes</a>
            </li>
            <li>
                <a href="#trajets" class="block py-2 px-4 rounded-md text-white hover:bg-primary transition duration-300">Gestion des Trajets</a>
            </li>
            <li>
                <a href="#reservations" class="block py-2 px-4 rounded-md text-white hover:bg-primary transition duration-300">Gestion des Réservations</a>
            </li>
            <li>
                <a href="#stats" class="block py-2 px-4 rounded-md text-white hover:bg-primary transition duration-300">Statistiques</a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 pt-16 pb-10 px-6">
        <!-- Section 1: Statistiques -->
        <section id="stats" class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-secondary">Statistiques</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white shadow-md p-6 rounded-md">
                    <h3 class="text-lg font-medium mb-2 text-secondary">Nombre d'Utilisateurs</h3>
                    <p class="text-2xl font-bold text-primary">{{ $userCount ?? 'N/A' }}</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white shadow-md p-6 rounded-md">
                    <h3 class="text-lg font-medium mb-2 text-secondary">Nombre de Villes</h3>
                    <p class="text-2xl font-bold text-primary">{{ $villeCount ?? 'N/A' }}</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white shadow-md p-6 rounded-md">
                    <h3 class="text-lg font-medium mb-2 text-secondary">Nombre de Trajets</h3>
                    <p class="text-2xl font-bold text-primary">{{ $trajetCount ?? 'N/A' }}</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-white shadow-md p-6 rounded-md">
                    <h3 class="text-lg font-medium mb-2 text-secondary">Nombre de Réservations</h3>
                    <p class="text-2xl font-bold text-primary">{{ $reservationCount ?? 'N/A' }}</p>
                </div>
            </div>
        </section>

        <!-- Section 2: Gestion des Utilisateurs -->
        <section id="users" class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-secondary">Gestion des Utilisateurs</h2>
            <table class="w-full border-collapse bg-white shadow-md rounded-md overflow-hidden">
                <thead class="bg-yellow-500 text-white">
                    <tr>
                        <th class="py-2 px-4">#</th>
                        <th class="py-2 px-4">Nom</th>
                        <th class="py-2 px-4">Email</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4">{{ $user->id }}</td>
                            <td class="py-2 px-4">{{ $user->name }}</td>
                            <td class="py-2 px-4">{{ $user->email }}</td>
                            <td class="py-2 px-4">
                            <div>
                                <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</a> <!-- Yellow button -->
                                
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Delete</button> <!-- Green button -->
                                </form>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4 flex justify-center">
                {{ $users->links() }}
            </div>
        </section>

        <!-- Section 3: Gestion des Villes -->
        <section id="villes" class="mb-8">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold mb-4 text-secondary">Gestion des Villes</h2>
                <button id="addCityButton" class="bg-gray-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="openModal()">
                    Ajouter Nouvelle Ville
                </button>
            </div>
            <table class="w-full border-collapse bg-white shadow-md rounded-md overflow-hidden">
                <thead class="bg-yellow-500 text-white">
                    <tr>
                        <th class="py-2 px-4">#</th>
                        <th class="py-2 px-4">Nom</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($villes as $ville)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4">{{ $ville->id }}</td>
                            <td class="py-2 px-4">{{ $ville->nom }}</td>
                            <td class="py-2 px-4">
                            <div>
                                    <a href="{{ route('villes.edit', $ville->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</a> <!-- Yellow button -->
                                    
                                    <form action="{{ route('villes.destroy', $ville->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Delete</button> <!-- Green button -->
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4 flex justify-center">
                {{ $villes->links() }}
            </div>
        </section>

        <!-- Section 4: Gestion des Trajets -->
        <section id="trajets" class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-secondary">Gestion des Trajets</h2>
            <table class="w-full border-collapse bg-white shadow-md rounded-md overflow-hidden">
                <thead class="bg-yellow-500 text-white">
                    <tr>
                        <th class="py-2 px-4">#</th>
                        <th class="py-2 px-4">Nom du Chauffeur</th>
                        <th class="py-2 px-4">Ville</th>
                        <th class="py-2 px-4">Départ</th>
                        <th class="py-2 px-4">Arrivée</th>
                        <th class="py-2 px-4">Prix</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trajets as $trajet)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4">{{ $trajet->id }}</td>
                            <td class="py-2 px-4">{{ $trajet->chauffeur->name }}</td>
                            <td class="py-2 px-4">{{ $trajet->ville->nom }}</td>
                            <td class="py-2 px-4">{{ $trajet->rue_depart }}</td>
                            <td class="py-2 px-4">{{ $trajet->rue_arrivee }}</td>
                            <td class="py-2 px-4">{{ $trajet->prix }} Dh</td>
                            <td class="py-2 px-4">
                            <div>
                                    <a href="{{ route('trajets.edit', $trajet->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</a> <!-- Yellow button -->
                                    
                                    <form action="{{ route('trajets.destroy', $trajet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Delete</button> <!-- Green button -->
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4 flex justify-center">
                {{ $trajets->links() }}
            </div>
        </section>

        <!-- Section 5: Gestion des Réservations -->
        <section id="reservations" class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-secondary">Gestion des Réservations</h2>
            <table class="w-full border-collapse bg-white shadow-md rounded-md overflow-hidden">
                <thead class="bg-yellow-500 text-white">
                    <tr>
                        <th class="py-2 px-4">#</th>
                        <th class="py-2 px-4">Utilisateur</th>
                        <th class="py-2 px-4">Trajet</th>
                        <th class="py-2 px-4">Date</th>
                        <th class="py-2 px-4">Prix</th>
                        <th class="py-2 px-4">Statut</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4">{{ $reservation->id }}</td>
                            <td class="py-2 px-4">{{ $reservation->Passager->name }}</td>
                            <td class="py-2 px-4">{{ $reservation->trajet->rue_depart }} - {{ $reservation->trajet->rue_arrivee }}</td>
                            <td class="py-2 px-4">{{ $reservation->trajet->heure_depart }}</td>
                            <td class="py-2 px-4">{{ $reservation->trajet->prix }} Dh</td>
                            <td class="py-2 px-4">{{ $reservation->statut }}</td>
                            <td class="py-2 px-4">
                                <div>
                                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</a> <!-- Yellow button -->
                                    
                                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Delete</button> <!-- Green button -->
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4 flex justify-center">
                {{ $reservations->links() }}
            </div>
        </section>
    </main>
        <!-- Modal -->
        <div id="addCityModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Ajouter Nouvelle Ville</h2>
                <form action="{{ route('villes.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom de la Ville</label>
                        <input type="text" name="nom" id="nom" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded mr-2" onclick="closeModal()">Annuler</button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add JavaScript to handle modal open/close -->
        <script>
            function openModal() {
                document.getElementById('addCityModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('addCityModal').classList.add('hidden');
            }
        </script>
    <!-- Footer -->
    <footer class="fixed bottom-0 left-0 w-full bg-secondary py-2 px-6 flex justify-between items-center text-white">
        <span class="text-sm">&copy; 2023 GrandTaxiGo</span>
        <span class="text-sm">Version 1.0</span>
    </footer>

    <!-- JavaScript pour améliorer l'expérience utilisateur -->
    <script>
        // Confirmation avant suppression
        document.querySelectorAll('.text-danger').forEach(button => {
            button.addEventListener('click', function(event) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>