<?php

require_once "../../config/database.php";

$sql = "SELECT 
            i.id_inscription,
            i.annee_scolaire,
            i.date_inscription,
            e.nom AS nom_eleve,
            e.prenom AS prenom_eleve,
            c.nom_classe
        FROM inscription i
        JOIN eleve e ON i.id_eleve = e.id_eleve
        JOIN classe c ON i.id_classe = c.id_classe
        ORDER BY i.id_inscription DESC";

$stmt = $pdo->query($sql);
$inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des inscriptions</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
<?php include "../../navbar.php"; ?>
<h1>Liste des inscriptions</h1>

<a class="btn" href="create.php">Ajouter une inscription</a>

<table class="table">

<tr>
    <th>ID</th>
    <th>Année scolaire</th>
    <th>Date</th>
    <th>Élève</th>
    <th>Classe</th>
    <th>Actions</th>
</tr>

<?php foreach ($inscriptions as $ins): ?>

<tr>
    <td><?= $ins['id_inscription'] ?></td>
    <td><?= htmlspecialchars($ins['annee_scolaire']) ?></td>
    <td><?= htmlspecialchars($ins['date_inscription']) ?></td>
    <td><?= htmlspecialchars($ins['nom_eleve'] . " " . $ins['prenom_eleve']) ?></td>
    <td><?= htmlspecialchars($ins['nom_classe']) ?></td>

    <td>
       <a class="edit-btn" href="edit.php?id=<?= $ins['id_inscription'] ?>">
            Modifier
        </a>

        <a class="delete-btn" href="delete.php?id=<?= $ins['id_inscription'] ?>"
           onclick="return confirm('Supprimer cette inscription ?')">
            Supprimer
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>