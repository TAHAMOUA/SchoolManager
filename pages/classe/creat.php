<?php

require_once "../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_classe = $_POST["nom_classe"];
    $niveau = $_POST["niveau"];
    $capacite_max = $_POST["capacite_max"];

    $sql = "INSERT INTO classe (nom_classe, niveau, capacite_max)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom_classe,
        $niveau,
        $capacite_max
    ]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une classe</title>
</head>

<body>

<h2>Ajouter une classe</h2>

<form method="POST">

    <label>Nom de la classe</label><br>
    <input type="text" name="nom_classe" required><br><br>

    <label>Niveau</label><br>
    <input type="text" name="niveau" required><br><br>

    <label>Capacité maximale</label><br>
    <input type="number" name="capacite_max" required><br><br>

    <button type="submit">Ajouter</button>

</form>

</body>
</html>