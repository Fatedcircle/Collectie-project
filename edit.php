<?php
session_start();
include_once('connectie.php');
include('header.php');

// Haal het ID van het item op uit de URL
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
} else {
    // Als er geen ID is opgegeven, toon dan een foutmelding
    die("Geen ID opgegeven!");
}

// Haal de huidige gegevens van het item op uit de database
$stmt = $pdo->prepare("SELECT * FROM games WHERE id = :id");
$stmt->execute([':id' => $item_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

// Controleren of het formulier is verzonden
if (isset($_POST['submit'])) {
    // De ingevoerde gegevens ophalen uit het formulier
    $titel = $_POST['titel'];
    $systeem = $_POST['systeem'];
    $categorie = $_POST['categorie'];
    $beschrijving = $_POST['beschrijving'];
    $boxart = file_get_contents($_FILES['boxart']['tmp_name']);
    $user_id = $_SESSION['user_id'];

    // Het item bijwerken in de games-tabel
    $stmt = $pdo->prepare("UPDATE games SET titel = :titel, systeem = :systeem, categorie = :categorie, beschrijving = :beschrijving, boxart = :boxart, user_id = :user_id WHERE id = :id");
    $stmt->execute([
        ':titel' => $titel,
        ':systeem' => $systeem,
        ':categorie' => $categorie,
        ':beschrijving' => $beschrijving,
        ':boxart' => $boxart,
        ':user_id' => $user_id,
        ':id' => $item_id
    ]);

    // Een bevestigingsbericht tonen
    echo "Het item is bijgewerkt in de database!";
}

// Haal de huidige waarden van de system ENUM-kolom op
$stmt = $pdo->query("SHOW COLUMNS FROM games WHERE Field = 'systeem'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$systeemEnumValues = explode("','", trim($row['Type'], "enum('')"));
?>
<div class="content edit">
    <div class="nieuw-item">
        <div class="container">
            <h1 class="nieuw-item">Bewerk item</h1>
            <div class="row">
                <div class="col-12">
                    <form method="post" enctype="multipart/form-data">
                        <label for="titel" class="form-label">Titel:</label>
                        <input type="text" class="form-control" name="titel" id="titel" value="<?= htmlspecialchars($item['titel']) ?>" required><br>
                        <label for="systeem" class="form-label">Systeem:</label>
                        <select class="form-select" name="systeem" id="systeem">
                            <?php foreach ($systeemEnumValues as $value) : ?>
                                <option value="<?= htmlspecialchars($value) ?>" <?= ($item['systeem'] == $value) ? 'selected' : '' ?>><?= htmlspecialchars($value) ?></option>
                            <?php endforeach; ?>
                        </select><br>
                        <label for="categorie" class="form-label">Categorie:</label>
                        <select class="form-select" name="categorie" id="categorie" required>
                            <option value="platformer" <?= ($item['categorie'] == 'platformer') ? 'selected' : '' ?>>Platformer</option>
                            <option value="shooter" <?= ($item['categorie'] == 'shooter') ? 'selected' : '' ?>>Shooter</option>
                            <option value="rpg" <?= ($item['categorie'] == 'rpg') ? 'selected' : '' ?>>Roleplaying game</option>
                        </select><br>
                        <label for="beschrijving" class="form-label">Beschrijving:</label>
                        <textarea name="beschrijving" class="form-control" id="beschrijving"><?= htmlspecialchars($item['beschrijving']) ?></textarea><br>
                        <label for="boxart" class="form-label">Boxart:</label>
                        <input type="file" class="form-control" name="boxart" id="boxart"><br>
                        <input type="submit" name="submit" value="Bijwerken">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
