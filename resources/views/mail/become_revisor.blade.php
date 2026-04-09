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
        <h1>{{ __('revisor.mail_title') }}</h1>
        <h2>{{ __('revisor.mail_subtitle') }}</h2>
        <p><strong>{{ __('revisor.mail_name') }}:</strong> {{ $user->name }}</p>
        <p><strong>{{ __('revisor.mail_email') }}:</strong> {{ $user->email }}</p>
        <p><strong>{{ __('revisor.mail_message') }}:</strong> {{ $requestMessage }}</p>
        <p>{{ __('revisor.mail_instruction') }}</p>
    </div>
</body>

</html>
