<?php

require_once "../../config/database.php";

$errors = [];

if (!isset($_GET['id'])) {
    die("ID introuvable.");
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM eleve WHERE id_eleve = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

$eleve = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$eleve) {
    die("Élève introuvable.");
}

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

    if (empty($errors)) {

        $sql = "UPDATE eleve
                SET matricule = :matricule,
                    nom = :nom,
                    prenom = :prenom,
                    email = :email
                WHERE id_eleve = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':matricule' => $matricule,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':id' => $id
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
    <title>Modifier un élève</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

<h1>Modifier un élève</h1>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST">

    <label>Matricule</label><br>
    <input type="text" name="matricule"
           value="<?= htmlspecialchars($eleve['matricule']) ?>">
    <br><br>

    <label>Nom</label><br>
    <input type="text" name="nom"
           value="<?= htmlspecialchars($eleve['nom']) ?>">
    <br><br>

    <label>Prénom</label><br>
    <input type="text" name="prenom"
           value="<?= htmlspecialchars($eleve['prenom']) ?>">
    <br><br>

    <label>Email</label><br>
    <input type="email" name="email"
           value="<?= htmlspecialchars($eleve['email']) ?>">
    <br><br>

    <button type="submit">
        Modifier
    </button>

</form>

</body>
</html>