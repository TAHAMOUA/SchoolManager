<?php

require_once "../../config/database.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM matiere WHERE id_matiere = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$matiere = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$matiere) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_matiere = $_POST["nom_matiere"];
    $coefficient = $_POST["coefficient"];

    $sql = "UPDATE matiere 
            SET nom_matiere = ?, coefficient = ?
            WHERE id_matiere = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom_matiere, $coefficient, $id]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier matière</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Modifier matière</h1>

<div class="form-container">

    <form method="POST">

        <div class="form-group">
            <label>Nom de la matière</label>
            <input type="text" name="nom_matiere"
                   value="<?= htmlspecialchars($matiere['nom_matiere']) ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Coefficient</label>
            <input type="number" name="coefficient" min="1"
                   value="<?= htmlspecialchars($matiere['coefficient']) ?>"
                   required>
        </div>

        <button type="submit">Modifier</button>

    </form>

</div>

</body>
</html>