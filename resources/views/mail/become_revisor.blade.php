<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatibile" content="ie=edge">
    <title>Presto.it</title>
</head>

<body>
    <div>
        <h1>Un utente ha chiesto di lavorare con noi</h1>
        <h2>Ecco i suoi dati:</h2>
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Messaggio:</strong> {{ $requestMessage }}</p>
        <p>Per renderlo revisore puoi usare il comando artisan con la sua email.</p>
    </div>
</body>

</html>
