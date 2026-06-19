<?php

require_once "../../config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

// جلب البيانات ديال الأستاذ
$sql = "SELECT * FROM enseignant WHERE id_enseignant = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$ens = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ens) {
    header("Location: index.php");
    exit();
}

// update
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matricule = $_POST["matricule"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $specialite = $_POST["specialite"];

    $sql = "UPDATE enseignant 
            SET matricule = ?, nom = ?, prenom = ?, email = ?, telephone = ?, specialite = ?
            WHERE id_enseignant = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $matricule,
        $nom,
        $prenom,
        $email,
        $telephone,
        $specialite,
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
    <title>Modifier enseignant</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Modifier enseignant</h1>

<div class="form-container">

<form method="POST">

    <label>Matricule</label>
    <input type="text" name="matricule" value="<?= htmlspecialchars($ens['matricule']) ?>" required>

    <label>Nom</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($ens['nom']) ?>" required>

    <label>Prénom</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($ens['prenom']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($ens['email']) ?>" required>

    <label>Téléphone</label>
    <input type="text" name="telephone" value="<?= htmlspecialchars($ens['telephone']) ?>">

    <label>Spécialité</label>
    <input type="text" name="specialite" value="<?= htmlspecialchars($ens['specialite']) ?>">

    <button type="submit">Modifier</button>

</form>

</div>

</body>
</html>