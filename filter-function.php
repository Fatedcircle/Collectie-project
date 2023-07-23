<?php
$selectedSystem = isset($_GET['systeem']) ? $_GET['systeem'] : '';
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

if (isset($games)) {
    $filteredGames = array_filter($games, function ($game) use ($selectedSystem, $selectedCategory) {
        if (!empty($selectedSystem) && $game['systeem'] != $selectedSystem) {
            return false;
        }
        if (!empty($selectedCategory) && $game['categorie'] != $selectedCategory) {
            return false;
        }
        return true;
    });
} else {
    // Handle the case where $games is not set
    // For example, set $filteredGames to an empty array or show an error message
    $filteredGames = [];
}

