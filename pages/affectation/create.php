<?php

require_once "../../config/database.php";

$enseignants = $pdo->query("SELECT * FROM enseignant")->fetchAll(PDO::FETCH_ASSOC);
$classes = $pdo->query("SELECT * FROM classe")->fetchAll(PDO::FETCH_ASSOC);
$matieres = $pdo->query("SELECT * FROM matiere")->fetchAll(PDO::FETCH_ASSOC);

/* insert */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_enseignant = $_POST["id_enseignant"];
    $id_classe = $_POST["id_classe"];
    $id_matiere = $_POST["id_matiere"];
    $date_affectation = $_POST["date_affectation"];

    $sql = "INSERT INTO affectation 
            (id_enseignant, id_classe, id_matiere, date_affectation)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $id_enseignant,
        $id_classe,
        $id_matiere,
        $date_affectation
    ]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter affectation</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Ajouter une affectation</h1>

<div class="form-container">

<form method="POST">

    <label>Date affectation</label>
    <input type="date" name="date_affectation" required>

    <label>Enseignant</label>
    <select name="id_enseignant" required>
        <option value="">-- Choisir enseignant --</option>
        <?php foreach ($enseignants as $e): ?>
            <option value="<?= $e['id_enseignant'] ?>">
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

    <label>Matière</label>
    <select name="id_matiere" required>
        <option value="">-- Choisir matière --</option>
        <?php foreach ($matieres as $m): ?>
            <option value="<?= $m['id_matiere'] ?>">
                <?= htmlspecialchars($m['nom_matiere']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Ajouter</button>

</form>

</div>

</body>
</html>