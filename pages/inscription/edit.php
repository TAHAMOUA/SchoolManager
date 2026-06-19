<?php

require_once "../../config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

/* جلب inscription الحالية */
$sql = "SELECT * FROM inscription WHERE id_inscription = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$ins = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ins) {
    header("Location: index.php");
    exit();
}

/* data للselect */
$eleves = $pdo->query("SELECT * FROM eleve")->fetchAll(PDO::FETCH_ASSOC);
$classes = $pdo->query("SELECT * FROM classe")->fetchAll(PDO::FETCH_ASSOC);

/* update */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $annee_scolaire = $_POST["annee_scolaire"];
    $date_inscription = $_POST["date_inscription"];
    $id_eleve = $_POST["id_eleve"];
    $id_classe = $_POST["id_classe"];

    $sql = "UPDATE inscription 
            SET annee_scolaire = ?, date_inscription = ?, id_eleve = ?, id_classe = ?
            WHERE id_inscription = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $annee_scolaire,
        $date_inscription,
        $id_eleve,
        $id_classe,
        $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier inscription</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Modifier inscription</h1>

<div class="form-container">

<form method="POST">

    <label>Année scolaire</label>
    <input type="text" name="annee_scolaire"
           value="<?= htmlspecialchars($ins['annee_scolaire']) ?>" required>

    <label>Date inscription</label>
    <input type="date" name="date_inscription"
           value="<?= htmlspecialchars($ins['date_inscription']) ?>" required>

    <label>Élève</label>
    <select name="id_eleve" required>
        <?php foreach ($eleves as $e): ?>
            <option value="<?= $e['id_eleve'] ?>"
                <?= $e['id_eleve'] == $ins['id_eleve'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nom'] . " " . $e['prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Classe</label>
    <select name="id_classe" required>
        <?php foreach ($classes as $c): ?>
            <option value="<?= $c['id_classe'] ?>"
                <?= $c['id_classe'] == $ins['id_classe'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['nom_classe']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Modifier</button>

</form>

</div>

</body>
</html>