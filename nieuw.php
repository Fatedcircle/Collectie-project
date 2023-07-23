<?php
session_start();
include_once('connectie.php');
include('header.php');

// Controleren of het formulier is verzonden
if (isset($_POST['submit'])) {
    // De ingevoerde gegevens ophalen uit het formulier
    $titel = $_POST['titel'];
    $systeem = $_POST['systeem'];
    $systeemeisen = $_POST['systeemeisen'];
    $categorie = $_POST['categorie'];
    $beschrijving = $_POST['beschrijving'];
    $boxart = file_get_contents($_FILES['boxart']['tmp_name']);
    $user_id = $_SESSION['user_id'];

    // Een nieuw item toevoegen aan de games-tabel
    $stmt = $pdo->prepare("INSERT INTO games (titel, systeem, categorie, beschrijving, boxart, user_id, systeemeisen) VALUES (:titel, :systeem, :categorie, :beschrijving, :boxart, :user_id, :systeemeisen)");
    $stmt->execute([
        ':titel' => $titel,
        ':systeem' => $systeem,
        ':systeemeisen' => $systeemeisen,
        ':categorie' => $categorie,
        ':beschrijving' => $beschrijving,
        ':boxart' => $boxart,
        ':user_id' => $user_id
    ]);

    // Een bevestigingsbericht tonen
    echo "<div class='alert alert-success text-center'>Het item is toegevoegd aan de database!<br>
    Als u geen nieuwe items wilt toevoegen kan u op home klikken in de navigatiebalk</div>";
}



// Haal de huidige waarden van de system ENUM-kolom op
$stmt = $pdo->query("SHOW COLUMNS FROM games WHERE Field = 'systeem'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$systeemEnumValues = explode("','", trim($row['Type'], "enum('')"));
?>
<div class="content">
    <div class="nieuw-item">
        <div class="container">
            <h1 class="nieuw-item">Voeg nieuw item toe</h1>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="text-center">Voeg nieuwe game toe</h2>
                    <form method="post" enctype="multipart/form-data" id="game-form">
                        <label for="titel" class="form-label">Titel:</label>
                        <input type="text" class="form-control" name="titel" id="titel" required><br>
                        <label for="systeem" class="form-label">Systeem:</label>
                        <select class="form-select" name="systeem" id="systeem" required>
                            <?php foreach ($systeemEnumValues as $value) : ?>
                                <option value="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                            <?php endforeach; ?>
                        </select><br>
                        <label for="systeemeisen" class="form-label">Systeemeisen:</label>
                        <input type="text" class="form-control" name="systeemeisen" id="systeemeisen">
                        <label for="categorie" class="form-label">Categorie:</label>
                        <select class="form-select" name="categorie" id="categorie" required>
                            <option value="platformer">Platformer</option>
                            <option value="shooter">Shooter</option>
                            <option value="rpg">Roleplaying game</option>
                        </select><br>
                        <label for="beschrijving" class="form-label">Beschrijving:</label>
                        <textarea name="beschrijving" class="form-control" id="beschrijving"></textarea><br>
                        <label for="boxart" class="form-label">Boxart:</label>
                        <input type="file" class="form-control" name="boxart" id="boxart" required><br>
                        <input type="submit" name="submit" value="Toevoegen">
                    </form>
                </div>
                <div class="col-12 col-md-6"><?php include('system-categorie-nieuw.php'); ?></div>
            </div>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>

