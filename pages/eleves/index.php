<?php

require_once "../../config/database.php";

$sql = "SELECT * FROM eleve";
$stmt = $pdo->query($sql);
$eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des élèves</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
<?php include "../../navbar.php"; ?>
<h1>Liste des élèves</h1>

<a href="create.php">Ajouter un élève</a>

<table>

    <tr>
        <th>ID</th>
        <th>Matricule</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($eleves as $eleve): ?>

    <tr>
        <td><?= htmlspecialchars($eleve['id_eleve']) ?></td>
        <td><?= htmlspecialchars($eleve['matricule']) ?></td>
        <td><?= htmlspecialchars($eleve['nom']) ?></td>
        <td><?= htmlspecialchars($eleve['prenom']) ?></td>
        <td><?= htmlspecialchars($eleve['email']) ?></td>

        <td>
            <a class="edit-btn"
               href="edit.php?id=<?= $eleve['id_eleve'] ?>">
               Modifier
            </a>
            
            <a class="delete-btn"
               href="delete.php?id=<?= $eleve['id_eleve'] ?>"
               onclick="return confirm('Voulez-vous vraiment supprimer cet élève ?')">
               Supprimer
            </a>
        </td>
    </tr>

    <?php endforeach; ?>

</table>

</body>
</html>