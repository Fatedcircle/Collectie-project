# Game collectie project

## Om dit te gebruiken heb je het volgende nodig

1. Een Php server en een mysql server voor lokaal gebruik kan je [Xampp](https://www.apachefriends.org/) gebruiken.
2. Indien noodzakelijk moet je wel even een mysql user aanmaken om de imports te kunnen gebruiken buiten de root om en het connectie.php bestand aanpassen naar de juiste login
3. Ook heb je de bijgevoegde import.sql nodig of de import-met-sample.sql nodig.

## Hoe te gebruiken zonder Sample data
1. Je importeerd het import.sql bestand in je database.
2. Je gaat naar de registreer pagina en kiest een gebruikersnaam en password die vul je in het formulier in.
3. Na het registreren word je doorgestuurd naar de login pagina daar kan je je inloggen met je zojuist aangemaakte gebruikersnaam en password.
4. Wanneer je ingelogd bent heb je in de navigatie balk nieuw en logout staan in plaats van login en registreer.
5. Je kan een nieuw item toevoegen aan de database door op nieuw te klikken het formulier in te vullen en te versturen.
6. Na dat je items hebt toegevoegd aan de database kan je op home klikken en dan staat je item daar.

## Hoe te gebruiken met de sample data
1. Je importeerd het import-met-sample.sql bestand in je database.
2. Je klikt op login in de navigatie balk in het formulier vul je bij gebruikersnaam ``test`` in en bij wachtwoord ``test``
3. de rest is hetzelfde van punt 4 tot punt 6 van hoe te gebruiken zonder sample data.


### Functies van de website

Je kan je collectie games laten zien door middel van een database connectie.  
Je kan nieuwe games toevoegen en die dus vervolgens laten zien.  
Je kan filteren op basis van welk systeem de games zijn en op categorieën.  
Ook kan het gesorteerd worden op ``titel``, ``systeem`` of ``categorie``.
Aan de rechterkant staan de recent toegevoegde items van iedereen die de website gebruikt met de naam wie het heeft toegevoegd en je kan meer details bekijken.  
In het midden staan de items die je zelf hebt toegevoegd en die kun je ook filteren zoals eerder genoemd.  
Bij nieuw kan je niet alleen games toevoegen maar ook andere systemen en/of categorieën.  
Als er items zijn toegevoegd kan je de details bekijken van het betreffende item daar kan je als je zelf het item hebt toegevoegd het item editen of verwijderen.  
Bij het bekijken van de details van een item staan aan de rechterkant.
Er word gebruik gemaakt van sessies dus als je de browser afsluit ben je uitgelogd.
De filter op de homepage word uit zichzelf aangepast als er nieuwe systemen of categorieën toegevoegd worden.
Je kan alleen de systeemeisen, de categorie, wie het heeft toegevoegd en het systeem zelf niet aanpassen in het edit formulier extra systemen en categorieën kunnen daar ook niet toegevoegd worden.
