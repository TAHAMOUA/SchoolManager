<?php

require_once "../../config/database.php";

$eleves = $pdo->query("SELECT * FROM eleve")->fetchAll(PDO::FETCH_ASSOC);
$classes = $pdo->query("SELECT * FROM classe")->fetchAll(PDO::FETCH_ASSOC);

/* insert */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $annee_scolaire = $_POST["annee_scolaire"];
    $date_inscription = $_POST["date_inscription"];
    $id_eleve = $_POST["id_eleve"];
    $id_classe = $_POST["id_classe"];

    $sql = "INSERT INTO inscription 
            (annee_scolaire, date_inscription, id_eleve, id_classe)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $annee_scolaire,
        $date_inscription,
        $id_eleve,
        $id_classe
    ]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter inscription</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Ajouter une inscription</h1>

<div class="form-container">

<form method="POST">

    <label>Année scolaire</label>
    <input type="text" name="annee_scolaire" placeholder="2025-2026" required>

    <label>Date inscription</label>
    <input type="date" name="date_inscription" required>

    <label>Élève</label>
    <select name="id_eleve" required>
        <option value="">-- Choisir élève --</option>
        <?php foreach ($eleves as $e): ?>
            <option value="<?= $e['id_eleve'] ?>">
                <?= htmlspecialchars($e['nom'] . " " . $e['prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Classe</label>
    <select name="id_classe" required>
        <option value="">-- Choisir classe --</option>
        <?php foreach ($classes as $c): ?>
            <option value="<?= $c['id_classe'] ?>">
                <?= htmlspecialchars($c['nom_classe']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Ajouter</button>

</form>

</div>

</body>
</html>