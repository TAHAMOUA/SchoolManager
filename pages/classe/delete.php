<?php

require_once "../../config/database.php";

$id = $_GET['id'];

$sql = "DELETE FROM classe WHERE id_classe = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
exit();
