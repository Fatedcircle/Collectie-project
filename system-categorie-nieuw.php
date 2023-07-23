<?php


// Controleren of er een nieuw systeem is toegevoegd
if (isset($_POST['add_systeem'])) {
    // Haal de huidige waarden van de system ENUM-kolom op
    $stmt = $pdo->query("SHOW COLUMNS FROM games WHERE Field = 'systeem'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $systeemEnumValues = explode("','", trim($row['Type'], "enum('')"));

    // Voeg een nieuwe waarde toe aan de system ENUM-kolom
    $newSysteemValue = $_POST['new_systeem'];
    if (!in_array($newSysteemValue, $systeemEnumValues)) {
        $systeemEnumValues[] = $newSysteemValue;
        $enumValuesString = implode("','", array_map(function ($value) {
            return addslashes($value);
        }, $systeemEnumValues));
        $stmt = $pdo->prepare("ALTER TABLE games MODIFY systeem ENUM('$enumValuesString')");
        $stmt->execute();

        // Een bevestigingsbericht tonen
        echo "<div class='alert alert-success text-center'>Het nieuwe systeem is toegevoegd aan de database!</div>";
    } else {
        // Een foutbericht tonen als het systeem al bestaat
        echo "<div class='alert alert-danger text-center'>Het opgegeven systeem bestaat al in de database.</div>";
    }
}
?>

<div class="nieuw-systeem">
    <div class="container">
        <h2 class="nieuw-systeem">Voeg nieuw systeem toe</h2>
        <div class="row">
            <div class="col-12">
                <form method="post">
                    <label for="new_systeem" class="form-label">Nieuw systeem:</label>
                    <input type="text" class="form-control" name="new_systeem" id="new_systeem" required><br>
                    <input type="submit" name="add_systeem" value="Toevoegen">
                </form>
            </div>
        </div>
    </div>
</div>

<?php

// Controleren of er een nieuwe categorie is toegevoegd
if (isset($_POST['add_category'])) {
    // Haal de huidige waarden van de categorie ENUM-kolom op
    $stmt = $pdo->query("SHOW COLUMNS FROM games WHERE Field = 'categorie'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $categoryEnumValues = explode("','", trim($row['Type'], "enum('')"));

    // Voeg een nieuwe waarde toe aan de categorie ENUM-kolom
    $newCategoryValue = $_POST['new_category'];
    if (!in_array($newCategoryValue, $categoryEnumValues)) {
        $categoryEnumValues[] = $newCategoryValue;
        $enumValuesString = implode("','", array_map(function ($value) {
            return addslashes($value);
        }, $categoryEnumValues));
        $stmt = $pdo->prepare("ALTER TABLE games MODIFY categorie ENUM('$enumValuesString')");
        $stmt->execute();

        // Een bevestigingsbericht tonen
        echo "<div class='alert alert-success text-center'>De nieuwe categorie is toegevoegd aan de database!</div>";
    } else {
        // Een foutbericht tonen als de categorie al bestaat
        echo "<div class='alert alert-danger text-center'>De opgegeven categorie bestaat al in de database.</div>";
    }
}
?>

<div class="nieuwe-categorie">
    <div class="container">
        <h2 class="nieuwe-categorie">Voeg nieuwe categorie toe</h2>
        <div class="row">
            <div class="col-12">
                <form method="post">
                    <label for="new_category" class="form-label">Nieuwe categorie:</label>
                    <input type="text" class="form-control" name="new_category" id="new_category" required><br>
                    <input type="submit" name="add_category" value="Toevoegen">
                </form>
            </div>
        </div>
    </div>
</div>