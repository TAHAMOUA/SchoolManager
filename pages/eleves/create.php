<?php

require_once "../../config/database.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $matricule = trim($_POST['matricule']);
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);

    // Validation
    if (empty($matricule)) {
        $errors[] = "Le matricule est obligatoire.";
    }

    if (empty($nom)) {
        $errors[] = "Le nom est obligatoire.";
    }

    if (empty($prenom)) {
        $errors[] = "Le prénom est obligatoire.";
    }

    if (empty($email)) {
        $errors[] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format d'email invalide.";
    }

    // Si aucune erreur
    if (empty($errors)) {

        $sql = "INSERT INTO eleve
                (matricule, nom, prenom, email)
                VALUES
                (:matricule, :nom, :prenom, :email)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':matricule' => $matricule,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email
        ]);

        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter un élève</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

<h1>Ajouter un élève</h1>

<?php if (!empty($errors)): ?>

    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

<form method="POST">

    <label>Matricule</label><br>
    <input type="text" name="matricule"><br><br>

    <label>Nom</label><br>
    <input type="text" name="nom"><br><br>

    <label>Prénom</label><br>
    <input type="text" name="prenom"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <button type="submit">
        Ajouter
    </button>

</form>

</body>
</html>