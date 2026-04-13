# Presto

Presto e un progetto e-commerce sviluppato con Laravel che permette agli utenti di pubblicare, cercare e consultare articoli online tramite un'interfaccia semplice, moderna e responsive.

Il progetto include autenticazione, gestione articoli, revisione contenuti, supporto multilingua e analisi immagini.

## Funzionalita principali

- registrazione e login utenti
- creazione e pubblicazione articoli
- upload immagini con watermark automatico
- moderazione articoli tramite dashboard revisore
- storico articoli approvati o rifiutati
- modifica articoli da parte del revisore
- supporto multilingua in italiano, inglese e spagnolo
- analisi immagini con Google Vision
- blur dei volti tramite job dedicato
- interfaccia responsive per desktop e mobile

## Tecnologie utilizzate

- Laravel 13
- PHP 8.3+
- Livewire 3
- Fortify
- Bootstrap 5
- Bootstrap Icons
- Vite
- MySQL
- Mailtrap
- Google Cloud Vision
- Spatie Image / Imagick
- Blade Flags

## Requisiti

- PHP 8.3 o superiore
- Composer
- Node.js e npm
- database MySQL
- estensione PHP Imagick abilitata
- credenziali Google Vision valide

## Installazione

1. Clona il repository

```bash
git clone <repo-url>
cd presto_alice_accillaro
```

2. Installa le dipendenze backend e frontend

```bash
composer install
npm install
```

3. Crea il file di configurazione

```bash
copy .env.example .env
```

4. Configura il file `.env`

Imposta almeno:

- connessione al database
- credenziali Mailtrap
- locale applicazione
- eventuali impostazioni della coda

5. Genera la chiave applicativa

```bash
php artisan key:generate
```

6. Esegui migrazioni e link storage

```bash
php artisan migrate
php artisan storage:link
```

7. Avvia il progetto

```bash
composer run dev
```

Questo comando avvia:

- server Laravel
- coda job
- Vite

In alternativa puoi avviare i processi separatamente:

```bash
php artisan serve
php artisan queue:work
npm run dev
```

## Configurazioni esterne

### Mailtrap

Il progetto usa Mailtrap per la gestione delle mail in ambiente di sviluppo.

Configura nel file `.env`:

- `MAIL_MAILER`
- `MAIL_HOST`
- `MAIL_PORT`
- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_ENCRYPTION`

### Google Vision

Per le funzionalita di analisi immagini serve un file credenziali Google Cloud nella root del progetto:

```text
google_credential.json
```

Il file viene usato dai job che gestiscono:

- label detection
- safe search
- rilevamento volti

## Test

Per eseguire i test:

```bash
php artisan test
```

## Struttura del progetto

Le aree principali sono:

- `app/Http/Controllers` per la logica applicativa
- `app/Jobs` per elaborazione immagini e Google Vision
- `app/Livewire` per il form di creazione articolo
- `resources/views` per le pagine Blade
- `lang` per le traduzioni
- `resources/css/style.css` per lo stile principale

## Traduzioni

L'interfaccia del sito e disponibile in:

- italiano
- inglese
- spagnolo

I contenuti degli articoli restano nella lingua in cui vengono inseriti dagli utenti.

## Ruolo revisore

Il revisore puo:

- vedere gli articoli in attesa
- approvare o rifiutare un articolo
- modificare un articolo prima dell'approvazione
- consultare lo storico degli articoli revisionati
- modificare anche articoli gia approvati

## Autrice

Alice Accillaro
