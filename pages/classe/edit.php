<?php

require_once "../../config/database.php";

$id = $_GET['id'];

$sql = "SELECT * FROM classe WHERE id_classe = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$classe = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_classe = $_POST["nom_classe"];
    $niveau = $_POST["niveau"];
    $capacite_max = $_POST["capacite_max"];

    $sql = "UPDATE classe 
            SET nom_classe = ?, niveau = ?, capacite_max = ?
            WHERE id_classe = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $nom_classe,
        $niveau,
        $capacite_max,
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
    <title>Modifier classe</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

<h2>Modifier la classe</h2>

<form method="POST">

    <label>Nom</label><br>
    <input type="text" name="nom_classe" 
           value="<?= htmlspecialchars($classe['nom_classe']) ?>" required><br><br>

    <label>Niveau</label><br>
    <input type="text" name="niveau" 
           value="<?= htmlspecialchars($classe['niveau']) ?>" required><br><br>

    <label>Capacité maximale</label><br>
    <input type="number" name="capacite_max" 
           value="<?= htmlspecialchars($classe['capacite_max']) ?>" required><br><br>

    <button type="submit">Modifier</button>

</form>

</body>
</html>