<?php

require_once "../../config/database.php";

if (!isset($_GET['id'])) {
    die("ID introuvable.");
}

$id = (int) $_GET['id'];

$sql = "DELETE FROM eleve WHERE id_eleve = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

header("Location: index.php");
exit();