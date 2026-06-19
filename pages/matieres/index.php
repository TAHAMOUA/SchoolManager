<?php

require_once "../../config/database.php";

$sql = "SELECT * FROM matiere";
$stmt = $pdo->query($sql);
$matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des matières</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
<?php include "../../navbar.php"; ?>
<h1>Liste des matières</h1>

<a class="btn add-btn" href="create.php">+ Ajouter une matière</a>

<table class="table">

    <tr>
        <th>ID</th>
        <th>Nom matière</th>
        <th>Coefficient</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($matieres as $matiere): ?>

    <tr>
        <td><?= htmlspecialchars($matiere['id_matiere']) ?></td>
        <td><?= htmlspecialchars($matiere['nom_matiere']) ?></td>
        <td><?= htmlspecialchars($matiere['coefficient']) ?></td>

        <td>
            <a class="btn edit-btn"
               href="edit.php?id=<?= $matiere['id_matiere'] ?>">
               Modifier
            </a>

            <a class="btn delete-btn"
               href="delete.php?id=<?= $matiere['id_matiere'] ?>"
               onclick="return confirm('Voulez-vous supprimer cette matière ?')">
               Supprimer
            </a>
        </td>
    </tr>

    <?php endforeach; ?>

</table>

</body>
</html>