<?php

require_once "../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matricule = $_POST["matricule"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $specialite = $_POST["specialite"];

    $sql = "INSERT INTO enseignant 
            (matricule, nom, prenom, email, telephone, specialite)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $matricule,
        $nom,
        $prenom,
        $email,
        $telephone,
        $specialite
    ]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter enseignant</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Ajouter un enseignant</h1>

<div class="form-container">

<form method="POST">

    <label>Matricule</label>
    <input type="text" name="matricule" required>

    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Prénom</label>
    <input type="text" name="prenom" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Téléphone</label>
    <input type="text" name="telephone">

    <label>Spécialité</label>
    <input type="text" name="specialite">

    <button type="submit">Ajouter</button>

</form>

</div>

</body>
</html>