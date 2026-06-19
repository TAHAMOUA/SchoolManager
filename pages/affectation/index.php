<?php

require_once "../../config/database.php";

$sql = "SELECT 
            a.id_affectation,
            a.date_affectation,
            e.nom AS enseignant_nom,
            e.prenom AS enseignant_prenom,
            c.nom_classe,
            m.nom_matiere
        FROM affectation a
        JOIN enseignant e ON a.id_enseignant = e.id_enseignant
        JOIN classe c ON a.id_classe = c.id_classe
        JOIN matiere m ON a.id_matiere = m.id_matiere
        ORDER BY a.id_affectation DESC";

$stmt = $pdo->query($sql);
$affectations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des affectations</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
<?php include "../../navbar.php"; ?>
<h1>Liste des affectations</h1>

<a class="btn" href="create.php">Ajouter une affectation</a>

<table class="table">

<tr>
    <th>ID</th>
    <th>Date</th>
    <th>Enseignant</th>
    <th>Classe</th>
    <th>Matière</th>
    <th>Actions</th>
</tr>

<?php foreach ($affectations as $aff): ?>

<tr>
    <td><?= $aff['id_affectation'] ?></td>
    <td><?= $aff['date_affectation'] ?></td>
    <td><?= htmlspecialchars($aff['enseignant_nom'] . " " . $aff['enseignant_prenom']) ?></td>
    <td><?= htmlspecialchars($aff['nom_classe']) ?></td>
    <td><?= htmlspecialchars($aff['nom_matiere']) ?></td>

    <td>
        <a class="edit-btn" href="edit.php?id=<?= $aff['id_affectation'] ?>">Modifier</a>

        <a class="btn delete-btn"
            href="delete.php?id=<?= $aff['id_affectation'] ?>"
            onclick="return confirm('Voulez-vous supprimer cette affectation ?')">
            Supprimer
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>