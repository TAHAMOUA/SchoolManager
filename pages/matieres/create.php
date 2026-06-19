<?php

require_once "../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_matiere = $_POST["nom_matiere"];
    $coefficient = $_POST["coefficient"];

    $sql = "INSERT INTO matiere (nom_matiere, coefficient)
            VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom_matiere, $coefficient]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter matière</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Ajouter une matière</h1>

<div class="form-container">

    <form method="POST">

        <div class="form-group">
            <label>Nom de la matière</label>
            <input type="text" name="nom_matiere" required>
        </div>

        <div class="form-group">
            <label>Coefficient</label>
            <input type="number" name="coefficient" min="1" required>
        </div>

        <button type="submit">Ajouter</button>

    </form>

</div>

</body>
</html>