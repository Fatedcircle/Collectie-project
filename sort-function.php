
<?php
                    // Get the current sort column and order from the URL parameters, or use default values
$sortColumn = isset($_GET['sortColumn']) ? $_GET['sortColumn'] : 'titel';
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';

// Define the allowed sort columns and orders to prevent SQL injection
$allowedSortColumns = ['titel', 'systeem', 'categorie'];
$allowedSortOrders = ['ASC', 'DESC'];

// Validate the sort column and order
if (!in_array($sortColumn, $allowedSortColumns)) {
    $sortColumn = 'titel';
}
if (!in_array($sortOrder, $allowedSortOrders)) {
    $sortOrder = 'ASC';
}
if (isset($_SESSION['user_id'])) {
    // Create the SQL query with the sort column and order
    $stmt = $pdo->prepare("SELECT id, titel, systeem, categorie, beschrijving, boxart, created_at FROM games WHERE user_id = :user_id ORDER BY $sortColumn $sortOrder");
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $games = $stmt->fetchAll();
} else {
    // Handle the case where the user is not logged in
    // For example, redirect to the login page or show an error message
}
// Create the SQL query with the sort column and order

?>