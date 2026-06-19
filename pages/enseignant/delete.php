<?php

require_once "../../config/database.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM enseignant WHERE id_enseignant = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

}

header("Location: index.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">    
    <title>delete</title>
</head>
<body>
    
</body>
</html>