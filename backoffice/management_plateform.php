<?php
$msg='';
try{
	// On se connecte à MySQL
	$db = new PDO('mysql:host=localhost;dbname=filrouge;charset=utf8', 'root', '');
}
catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
if(isset($_GET['Id'])) {
	$id = strval($_GET['Id']);
	$query = 'DELETE FROM plateforms WHERE Id = :Id';
	$req = $db->prepare($query);
	$req->bindValue(':Id', $id, PDO::PARAM_INT);
	$req->execute();
	$msg='<h3 class="my-5 text-success">Plateforme supprimé .</h3>';
}

$query = 'SELECT * FROM plateforms';
$req = $db->prepare($query);
$req->execute();
$plateforms = $req->fetchAll();



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
    <?=$msg?>
    <div class="container">
    <p class="text-end">
	<a class="btn btn-primary text-end" href="index.php?page=add_plateform" role="button">Ajouter une Plateforme</a>
    </p>

    <table class="table table-bordered table-striped mx-auto">
        <thead>
            <tr class="table-secondary">
                <th>ID</th>
                <th>Plateforme</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            foreach($plateforms as $plateform){?>
            <tr>
                <td><?=$plateform['Id']?></td>
                <td><?=$plateform['name']?></td>
                <td class="text-center">
                <a class="btn btn-warning" href="index.php?page=edit_plateform&Id=<?=$plateform['Id']?>" role="button">Modifier</a>
				<a class="btn btn-danger" onclick="return(confirm('Voulez-vous supprimer cet plateform ?'));"
					href="?Id=<?=$plateform['Id']?>" role="button">Supprimer</a>
			    </td>
              </tr>
            <?php }?>
        </tbody>
    </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>