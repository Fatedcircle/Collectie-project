# Game Collectie Webapplicatie (Legacy PHP)

Vanilla PHP/MySQL CRUD-app (2023 teamlead-periode). Laravel-rebuild gepland.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-8511FA?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

## Over het project

Dit project is een **PHP/MySQL webapplicatie** waarmee gebruikers hun persoonlijke gamecollectie kunnen beheren en bekijken.  
Gebruikers kunnen zich registreren, inloggen en hun eigen games toevoegen, bewerken en verwijderen. Daarnaast biedt de applicatie filter- en sorteermogelijkheden en toont zij recent toegevoegde items van andere gebruikers.

Dit project is ontwikkeld om ervaring op te doen met **server-side webdevelopment**, **databases**, **gebruikersauthenticatie** en **CRUD-functionaliteit**.

---

## Gebruikte technologieën

- PHP (server-side logica)
- MySQL (relationele database)
- HTML / CSS
- PHP-sessies voor authenticatie
- XAMPP (lokale developmentomgeving)

---

## Functionaliteiten

- Gebruikersregistratie en login met sessiebeheer
- Persoonlijke gamecollectie per gebruiker
- Toevoegen, bewerken en verwijderen van games
- Ondersteuning voor meerdere systemen en categorieën
- Filteren op:
  - Systeem
  - Categorie
- Sorteren op:
  - Titel
  - Systeem
  - Categorie
- Overzicht van recent toegevoegde items door alle gebruikers
- Detailpagina per game met aanvullende informatie
- Dynamische filters die automatisch meeschalen met nieuw toegevoegde systemen en categorieën
- Toegangscontrole: alleen de eigenaar van een item kan deze bewerken of verwijderen

---

## Installatie & Setup

### Benodigdheden

- PHP-server en MySQL-server  
  *(Voor lokaal gebruik is [XAMPP](https://www.apachefriends.org/) aanbevolen)*
- MySQL-gebruiker met voldoende rechten
- Eén van de meegeleverde SQL-bestanden:
  - `import.sql`
  - `import-met-sample.sql`

### Configuratie

1. Importeer het gewenste SQL-bestand in je MySQL-database.
2. Pas indien nodig het bestand `connectie.php` aan met de juiste databasegegevens.
3. Start de PHP-server (bijvoorbeeld via XAMPP).
4. Open de applicatie in de browser.

---

## Gebruik zonder sample data

1. Importeer `import.sql`.
2. Registreer een nieuwe gebruiker via de registratiepagina.
3. Log in met de aangemaakte gegevens.
4. Voeg nieuwe games toe via de optie **Nieuw** in de navigatie.
5. Bekijk en beheer je collectie via de homepage.

---

## Gebruik met sample data

1. Importeer `import-met-sample.sql`.
2. Log in met:
   - **Gebruikersnaam:** `test`
   - **Wachtwoord:** `test`
3. De verdere functionaliteit is gelijk aan het gebruik zonder sample data.

---

## Architectuur & Ontwerpkeuzes

- Authenticatie wordt afgehandeld via PHP-sessies; bij het sluiten van de browser wordt de gebruiker automatisch uitgelogd.
- Filters en sorteermogelijkheden worden dynamisch opgebouwd op basis van database-inhoud.
- Bewerkrechten zijn bewust beperkt om dataconsistentie te waarborgen (bijvoorbeeld vaste systeemeisen en categorieën).

---

## Status & Roadmap

✅ Legacy PHP (functioneel, 2023) 
⏳ Laravel + React / tailwind

**Laravel Developer cert (2024)

