# Lege Symfony repository - Pas deze Readme aan!

Deze repo is leeg zodat je zelf snel met een repository kan werken. 

Zorg ervoor dat je deze Readme aanpast.

## Benodigdheden - Wat heb je geinstalleerd
* Composer
* Scoop
* Symfony-CLI

## Installatie
Clone de repository naar jouw computer/ laptop/ device

Open Powershell en ga naar de map van de repository

Type het commando ``composer install``

Maak een database aan (bijvoorbeeld symfony)

Kopieer het .env bestand naar .env.local

Zorg dat in de .env.local de juiste DB connectie string staat met wachtwoord etc.

Type het commando ``symfony console make:migration``

Type het commando ``symfony console doctrine:migrations:migrate``

Zet de backups van de symfony database via PHPMyAdmin terug (mapje backups)

Type het commando ``symfony server:start``

### Happy Hunting!
