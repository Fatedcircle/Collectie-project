<?php
session_start();
include_once('connectie.php');
include('header.php');
include('sort-function.php');
include('filter-function.php');
?>

<div class="content home">
    <div class="section container">


        <div class="menu-links col-2">


            <form method="get">
                <?php
                // Query uitvoeren om de waarden van de system enum op te halen
                $result = $pdo->query("SHOW COLUMNS FROM games WHERE Field = 'systeem'");
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $enum = str_replace("enum('", "", $row['Type']);
                $enum = str_replace("')", "", $enum);
                $systeemEnumValues = explode("','", $enum);

                // Query uitvoeren om de waarden van de categorie enum op te halen
                $result = $pdo->query("SHOW COLUMNS FROM games WHERE Field = 'categorie'");
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $enum = str_replace("enum('", "", $row['Type']);
                $enum = str_replace("')", "", $enum);
                $categoryEnumValues = explode("','", $enum);
                ?>

                <form method="get">
                    <label for="systeem">Systeem:</label><br>
                    <select name="systeem" id="systeem">
                        <option value="">All</option>
                        <?php foreach ($systeemEnumValues as $value) : ?>
                            <option value="<?php echo $value; ?>" <?php if ($selectedSystem == $value) echo 'selected'; ?>><?php echo ucfirst($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <label for="category">Category:</label><br>
                    <select name="category" id="category">
                        <option value="">All</option>
                        <?php foreach ($categoryEnumValues as $value) : ?>
                            <option value="<?php echo $value; ?>" <?php if ($selectedCategory == $value) echo 'selected'; ?>><?php echo ucfirst($value); ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <input type="submit" value="Filter">
                </form>

                <form method="get">
                    <label for="sortColumn">Sort by:</label><br>
                    <select name="sortColumn" id="sortColumn">
                        <option value="titel" <?php if ($sortColumn == 'titel') echo 'selected'; ?>>Titel</option>
                        <option value="systeem" <?php if ($sortColumn == 'systeem') echo 'selected'; ?>>Systeem</option>
                        <option value="categorie" <?php if ($sortColumn == 'categorie') echo 'selected'; ?>>Category</option>
                    </select><br>
                    <select name="sortOrder" id="sortOrder">
                        <option value="ASC" <?php if ($sortOrder == 'ASC') echo 'selected'; ?>>Ascending</option>
                        <option value="DESC" <?php if ($sortOrder == 'DESC') echo 'selected'; ?>>Descending</option>
                    </select><br>
                    <input type="submit" value="Sort">
                </form>

                <!-- Display the games -->
        </div>
        <div class="main col-12 col-lg-8">
            <div class="container-fluid">
                <?php if (isset($_SESSION['loggedInUser']) && $_SESSION['loggedInUser'] == true) : ?>
                    <h1 class="titel text-center">Dit is mijn game collectie</h1>

                    <div class="row">

                        <?php

                        foreach ($filteredGames as $game) {
                        ?><div class="col-12 col-sm-6 col-xl-4 col-xxl-3 my-2">
                                <div class="card h-100">

                                    <figure><img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($game['boxart']); ?>" /></figure>

                                    <div class="card-body">
                                        <h5 class="card-title text-center"><small><?php echo $game['titel']; ?></small></h5>
                                        <hr>
                                        <h6 class="card-subtitle"><?php echo $game['systeem']; ?></h6>
                                        <p class="card-text"><?php echo $game['categorie']; ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="created"><small>Toegevoegd op<br><?php echo date_format(date_create($game['created_at']), 'd-m-Y'); ?></small></p>
                                        <a href="game.php?id=<?php echo $game['id']; ?>" class="card-link">Meer details</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?></div>

                <?php else : ?>
                    <h1>You are not logged in</h1>
                <?php endif; ?>

            </div>
        </div>
        <div class="menu-rechts col-2">

            <h4 class="titel text-center">Laatste 5 toevoegingen</h4>
            <ul class="list-group">
                <?php
                // Haal de laatste 5 toevoegingen op uit de database
                $stmt = $pdo->prepare("SELECT games.id, games.titel, games.boxart, users.username FROM games JOIN users ON games.user_id = users.id ORDER BY games.created_at DESC LIMIT 5");
                $stmt->execute();
                $recentGames = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($recentGames as $game) {
                ?>

                    <div class="card p-3">
                        <figure><img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($game['boxart']); ?>" /></figure>
                        <h5 class="card-title text-center"><?php echo $game['titel']; ?></h5>
                        <p>Toegevoegd door: <?php echo $game['username']; ?></p>
                        <a href="game.php?id=<?php echo $game['id']; ?>" class="card-link">Meer details</a>
                    </div>


                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
</div>
</div>
<?php
include('footer.php');
?>