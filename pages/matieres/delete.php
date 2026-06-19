<?php

require_once "../../config/database.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM matiere WHERE id_matiere = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

}

header("Location: index.php");
exit();