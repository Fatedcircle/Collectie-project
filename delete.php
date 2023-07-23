
<?php
session_start();
include_once('connectie.php');
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM games WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: index.php");
}
?>
