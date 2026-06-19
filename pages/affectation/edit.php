<?php

require_once "../../config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

/* جلب affectation الحالية */
$sql = "SELECT * FROM affectation WHERE id_affectation = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$aff = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aff) {
    header("Location: index.php");
    exit();
}

/* جلب البيانات للselect */
$enseignants = $pdo->query("SELECT * FROM enseignant")->fetchAll(PDO::FETCH_ASSOC);
$classes = $pdo->query("SELECT * FROM classe")->fetchAll(PDO::FETCH_ASSOC);
$matieres = $pdo->query("SELECT * FROM matiere")->fetchAll(PDO::FETCH_ASSOC);

/* update */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_enseignant = $_POST["id_enseignant"];
    $id_classe = $_POST["id_classe"];
    $id_matiere = $_POST["id_matiere"];
    $date_affectation = $_POST["date_affectation"];

    $sql = "UPDATE affectation 
            SET id_enseignant = ?, id_classe = ?, id_matiere = ?, date_affectation = ?
            WHERE id_affectation = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $id_enseignant,
        $id_classe,
        $id_matiere,
        $date_affectation,
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
    <title>Modifier affectation</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Modifier affectation</h1>

<div class="form-container">

<form method="POST">

    <label>Date affectation</label>
    <input type="date" name="date_affectation"
           value="<?= htmlspecialchars($aff['date_affectation']) ?>" required>

    <label>Enseignant</label>
    <select name="id_enseignant" required>
        <?php foreach ($enseignants as $e): ?>
            <option value="<?= $e['id_enseignant'] ?>"
                <?= $e['id_enseignant'] == $aff['id_enseignant'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nom'] . " " . $e['prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Classe</label>
    <select name="id_classe" required>
        <?php foreach ($classes as $c): ?>
            <option value="<?= $c['id_classe'] ?>"
                <?= $c['id_classe'] == $aff['id_classe'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['nom_classe']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Matière</label>
    <select name="id_matiere" required>
        <?php foreach ($matieres as $m): ?>
            <option value="<?= $m['id_matiere'] ?>"
                <?= $m['id_matiere'] == $aff['id_matiere'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['nom_matiere']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Modifier</button>

</form>

</div>

</body>
</html>