<?php 
try{
    //se connecte a MySQL
    $db = new PDO ('mysql:host=localhost;dbname=filrouge;charset=utf8','root','');

} catch (Exception $e) {
    //en cas d'erreur
        die('Erreur : ' .$e->getMessage());

}


session_start();

if (!isset($_SESSION["lastname"])) {
    echo "il y a un soucis";

}



if (isset($_SESSION["lastname"])) {
    echo $_SESSION["lastname"];
    echo " ça marche";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <h5>Bienvenue Admin <?= $_SESSION['lastname'];?></h5>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>