<?php
session_start();
include_once('connectie.php');
include('header.php');
include('sort-function.php');
include('filter-function.php');
?>
<div class="content recent">
    <div class="section">
        <div class="container-fluid">
            <div class="row">
                
                    <?php

                    // Haal de laatste 5 toevoegingen op uit de database
                    $stmt = $pdo->prepare("SELECT games.id, games.title, games.boxart, users.username FROM games JOIN users ON games.user_id = users.id ORDER BY games.created_at DESC LIMIT 5");
                    $stmt->execute();
                    $recentGames = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($recentGames as $game) {
                    ?>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="card">
                                <figure><img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($game['boxart']); ?>" /></figure>
                                <h5 class="card-title"><?php echo $game['title']; ?></h5>
                                <p>Toegevoegd door: <?php echo $game['username']; ?></p>
                                <a href="game.php?id=<?php echo $game['id']; ?>" class="card-link">Meer details</a>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                
            </div>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>