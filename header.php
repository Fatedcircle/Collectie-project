<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game collectie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-md bg-body-tertiary">
    <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="bi bi-joystick">Game collectie</i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
    <?php
    if (isset($_SESSION['loggedInUser']) && $_SESSION['loggedInUser'] == true) {
        // Gebruiker is ingelogd
        echo '<li class="nav-item"><a class="nav-link" href="nieuw.php">Nieuw</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
    } else {
        // Gebruiker is niet ingelogd
        echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="register.php">Registreer</a></li>';
    }
    ?>
    <li class="nav-item recent"><a class="nav-link" href="recent.php">Recent</li></a>
    </ul>
    </div>
    </div>
</nav>
