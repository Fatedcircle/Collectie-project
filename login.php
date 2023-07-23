
<?php
    session_start();
    include_once('connectie.php');
    include('header.php');
    $error = "";
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Controleren of de gebruikersnaam en het wachtwoord correct zijn
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Inloggegevens zijn correct
        $_SESSION['loggedInUser'] = $username;
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
    } else {
        // Inloggegevens zijn onjuist
        $error = "Onjuiste gebruikersnaam of wachtwoord";
    }
}
?>

<div class="content login-page">
    <div class="login">
        <div class="container">
            <h1 class="titel text-center">Login formulier</h1>
            <?php if (!empty($error)) { ?>
    <div class="alert alert-danger text-center" role="alert">
        <?php echo $error; ?>
        <button type="button" class="btn-close position-absolute end-0" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
            <div class="row">
                <div class="col-12">
                <form action="login.php" method="post">
                <label for="username" class="form-label">Gebruikersnaam:</label>
                <input type="text" class="form-control" name="username" id="username" required>
                <br>
                <label for="password" class="form-label">Wachtwoord:</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <br>
                <input type="submit" value="inloggen">
                </form>
            </div></div>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>  
