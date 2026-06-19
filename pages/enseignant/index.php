<?php

require_once "../../config/database.php";

$sql = "SELECT * FROM enseignant";
$stmt = $pdo->query($sql);
$enseignants = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des enseignants</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
<?php include "../../navbar.php"; ?>
<h1>Liste des enseignants</h1>

<a class="btn" href="create.php">Ajouter un enseignant</a>

<table class="table">

<tr>
    <th>ID</th>
    <th>Matricule</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Email</th>
    <th>Téléphone</th>
    <th>Spécialité</th>
    <th>Actions</th>
</tr>

<?php foreach ($enseignants as $ens): ?>

<tr>
    <td><?= htmlspecialchars($ens['id_enseignant']) ?></td>
    <td><?= htmlspecialchars($ens['matricule']) ?></td>
    <td><?= htmlspecialchars($ens['nom']) ?></td>
    <td><?= htmlspecialchars($ens['prenom']) ?></td>
    <td><?= htmlspecialchars($ens['email']) ?></td>
    <td><?= htmlspecialchars($ens['telephone']) ?></td>
    <td><?= htmlspecialchars($ens['specialite']) ?></td>

    <td>
        <a class="edit-btn" href="edit.php?id=<?= $ens['id_enseignant'] ?>">
            Modifier
        </a>

        <a class="btn delete-btn"
            href="delete.php?id=<?= $ens['id_enseignant'] ?>"
            onclick="return confirm('Voulez-vous supprimer cet enseignant ?')">
            Supprimer
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>