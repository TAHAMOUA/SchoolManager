<?php

require_once "../../config/database.php";

$sql = "SELECT * FROM classe";
$stmt = $pdo->query($sql);
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des classes</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
<?php include "../../navbar.php"; ?>
<h1>Liste des classes</h1>

<a class="btn" href="create.php">Ajouter une classe</a>

<table class="table" border="1">

<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Niveau</th>
    <th>Actions</th>
</tr>

<?php foreach($classes as $classe): ?>

<tr>

<td><?= htmlspecialchars($classe['id_classe']) ?></td>
<td><?= htmlspecialchars($classe['nom_classe']) ?></td>
<td><?= htmlspecialchars($classe['niveau']) ?></td>

<td>

<a class="edit-btn" href="edit.php?id=...">Modifier</a>
<a class=" delete-btn"
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