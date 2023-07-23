<?php
session_start();
include_once('connectie.php');
include('header.php');
?>
<div class="content game">
    <div class="container-lg">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 class="text-center">Details</h1>
                <?php
                $id = $_GET['id'];
                $stmt = $pdo->prepare("SELECT * FROM games WHERE id = :id");
                $stmt->execute([':id' => $id]);
                $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($games as $game) {
                ?>
                    <div class="card">
                        <figure class="text-center mt-2"><img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($game['boxart']); ?>" /></figure>
                        <div class="card-body">
                            <h1><?php echo $game['titel']; ?></h1>
                            <div class="row my-3">
                                <div class="col-6 ">
                                    <p>Systeem:</p>
                                </div>
                                <div class="col-6"><?php echo $game['systeem']; ?></div>
                            </div>
                            <div class="row my-3">
                                <div class="col-6">
                                    <p>Categorie:</p>
                                </div>
                                <div class="col-6"><?php echo $game['categorie']; ?></div>
                            </div>
                            <?php if (!empty($game['systeemeisen'])) { ?>
                                <div class="row my-3">
                                    <div class="col-6">Systeemeisen:</div>
                                    <div class="col-6"><?php echo $game['systeemeisen']; ?></div>
                                </div>
                        </div>
                    <?php } ?>

                    <h2>Beschrijving</h2>
                    <p><?php echo $game['beschrijving'] ?></p>
                    </div>
                    <div class="edit-delete-knoppen d-flex mt-5"><?php if (isset($_SESSION['user_id']) && $game['user_id'] == $_SESSION['user_id']) {
                                                                        echo '<p><a class="btn btn-success"href="edit?id=' . $id . '">Edit Game</a></p>';
                                                                        echo '<form action="delete.php" class="text-end" method="POST" onsubmit="return confirmDelete()">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="submit" class="btn btn-danger" value="Delete Game">
          </form>';
                                                                    } ?>
                    </div>
            </div>
        <?php
                }
        ?>
        </div>
        <div class="col-12 col-md-3 interesant">
            <h5>Misschien ook interesant</h5><?php
                                                $id = $_GET['id'];
                                                $sql = "SELECT categorie FROM games WHERE id = ?";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                                                $stmt->execute();
                                                $row = $stmt->fetch();
                                                $categorie = $row['categorie'];

                                                // Selecteer 3 willekeurige items uit dezelfde categorie
                                                $sql = "SELECT * FROM games WHERE categorie = ? AND id != ? ORDER BY RAND() LIMIT 3";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->bindParam(1, $categorie, PDO::PARAM_STR);
                                                $stmt->bindParam(2, $id, PDO::PARAM_INT);
                                                $stmt->execute();

                                                // Toon de geselecteerde items
                                                while ($row = $stmt->fetch()) {
                                                    // Toon hier de gegevens van het item

                                                    echo '<div class="card">';
                                                    echo '<img class="card-img-top" src="data:image/jpeg;base64,' . base64_encode($row['boxart']) . '" alt="Card image cap">';
                                                    echo '<div class="card-body">';
                                                    echo '<h5 class="card-title">' . htmlspecialchars($row['titel']) . '</h5>';
                                                    echo '<p class="card-text">' . htmlspecialchars($row['systeem']) . '</p>';
                                                    echo '<p class="card-text">' . htmlspecialchars($row['categorie']) . '</p>';
                                                    echo '<a href="game.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-primary">Meer details</a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    // ...
                                                } ?>
        </div>
    </div>
</div>
</div>
<?php
include('footer.php');
?>
</body>

</html>