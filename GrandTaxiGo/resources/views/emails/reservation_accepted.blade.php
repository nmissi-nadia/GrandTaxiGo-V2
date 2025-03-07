<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Acceptée</title>
</head>
<body>
    <h1>Bonjour {{ $reservation->passager->name }},</h1>
    <p>Votre réservation avec le numéro <strong>{{ $reservation->id }}</strong> a été acceptée.</p>
    <p>Trajet prévu : {{ $reservation->trajet->rue_depart }} à {{ $reservation->trajet->rue_arrivee }}</p>
    <p>Date et heure : {{ $reservation->trajet->date_heure_depart }}</p>
    <p>Merci de faire confiance à GrandTaxiGo.</p>
</body>
</html>
