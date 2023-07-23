<?php
    session_start();
    include_once('connectie.php');
    include('header.php');
    // Variabele voor foutmelding
    $error = "";
    // Controleren of het formulier is verzonden
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Gegevens uit het formulier ophalen
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            // Gebruiker bestaat al, foutmelding opslaan
            $error = "Gebruiker bestaat al!";
        } else {
            // Wachtwoord hashen
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Nieuwe gebruiker toevoegen aan de database
            $sql = "INSERT INTO users (username, password) VALUES (:username, :hashed_password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':hashed_password', $hashed_password);
            $stmt->execute();

            // Display success message
            echo "<div class='alert alert-success text-center'>U bent succesvol geregistreerd. U gaat nu naar de login pagina.</div>";
            
            // Redirect to login page after 3 seconds
            echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 3000);</script>";
            
            exit();
        }
    }
?>

<div class="content">
    <div class="registratie">
        <div class="container">
            <h1 class="titel text-center">Registratie formulier</h1>
            
            <div class="row">
                <div class="col-12">
                <?php if (!empty($error)) { ?>
    <div class="alert alert-danger text-center" role="alert">
        <?php echo $error; ?>
        <button type="button" class="btn-close position-absolute end-0" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
                    <form action="register.php" method="post">
                    <label for="username" class="form-label">Gebruikersnaam:</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                    <br>
                    <label for="password"  class="form-label">Wachtwoord:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    <br>
                    <input type="submit" value="Registreren">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>  
</body>
</html>
