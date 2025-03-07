<!DOCTYPE html>
<html>
<head>
<title>QR Code des informations de l’utilisateur</title>
</head>
<body>
<h1>Informations de l’utilisateur</h1>
<p>Nom : {{ $user->name }}</p>
<p>Email : {{ $user->email }}</p>

<p>Le QR code avec les informations de l’utilisateur est en pi`ece jointe.</p>
</body>
</html>