<?php

require_once "../../config/database.php";

$id = $_GET['id'] ?? null;

if ($id) {

    $sql = "DELETE FROM inscription WHERE id_inscription = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

}

header("Location: index.php");
exit();