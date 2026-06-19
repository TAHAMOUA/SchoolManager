<?php
require_once "config/database.php";

/* counts */
$eleves = $pdo->query("SELECT COUNT(*) FROM eleve")->fetchColumn();
$classes = $pdo->query("SELECT COUNT(*) FROM classe")->fetchColumn();
$enseignants = $pdo->query("SELECT COUNT(*) FROM enseignant")->fetchColumn();
$matieres = $pdo->query("SELECT COUNT(*) FROM matiere")->fetchColumn();
$affectations = $pdo->query("SELECT COUNT(*) FROM affectation")->fetchColumn();
$inscriptions = $pdo->query("SELECT COUNT(*) FROM inscription")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard School Manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>🏫 School Manager</h2>
    <div>
        <a href="pages/eleves/index.php">Élèves</a>
        <a href="pages/classe/index.php">Classes</a>
        <a href="pages/enseignant/index.php">Enseignants</a>
        <a href="pages/matieres/index.php">Matières</a>
        <a href="pages/affectation/index.php">Affectations</a>
        <a href="pages/inscription/index.php">Inscriptions</a>
    </div>
</div>

<!-- DASHBOARD STATS -->
<h1>Dashboard</h1>

<table class="table">

<tr>
    <th>Module</th>
    <th>Total</th>
</tr>

<tr>
    <td>Élèves</td>
    <td><?= $eleves ?></td>
</tr>

<tr>
    <td>Classes</td>
    <td><?= $classes ?></td>
</tr>

<tr>
    <td>Enseignants</td>
    <td><?= $enseignants ?></td>
</tr>

<tr>
    <td>Matières</td>
    <td><?= $matieres ?></td>
</tr>

<tr>
    <td>Affectations</td>
    <td><?= $affectations ?></td>
</tr>

<tr>
    <td>Inscriptions</td>
    <td><?= $inscriptions ?></td>
</tr>

</table>

<!-- FOOTER -->
<div class="footer">
    <p>© 2026 School Manager - All rights reserved</p>
</div>

</body>
</html>
