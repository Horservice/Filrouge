<?php
try{
	// On se connecte à MySQL
	$db = new PDO('mysql:host=localhost;dbname=filrouge;charset=utf8', 'root', '');
}
catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$msg="";
if(isset($_GET['Id'])) {
	$Id = strval($_GET['Id']);
	$query = 'SELECT * FROM category WHERE Id = :Id';
	$req = $db->prepare($query);
	$req->bindValue(':Id', $Id, PDO::PARAM_INT);
	$req->execute();
	$category = $req->fetch();

	$name = $category['name'];
	$description = $category['description'];
	$path = $category['path'];

	if(isset($_POST['submit'])){
		if (!isset($_POST['name']) || empty($_POST['name'])
		|| (!isset($_POST['description']) || empty($_POST['description']))
		|| (!isset($_POST['path']) || empty($_POST['path']))){
			
		echo 'Il faut faut remplir tous les champs pour soumettre le formulaire.';
			exit;
		} else {
			$name = strip_tags($_POST['name']);
			$description = strip_tags($_POST['descrpition']);
			$path = strip_tags($_POST['path']);
			$Id = strval($_GET['Id']);
	
			$query = 'UPDATE category SET name = :name, description = :description, path = :path WHERE Id = :Id';
			$req = $db->prepare($query);
			$req->bindValue(':name', $name, PDO::PARAM_STR);
			$req->bindValue(':description', $description, PDO::PARAM_STR);
			$req->bindValue(':path', $path, PDO::PARAM_STR);
			$req->bindValue(':Id', $Id, PDO::PARAM_INT);
			$req->execute();
			$msg=$msg='<h3 class="my-5 text-warning">Informations modifiées.</h3>';;
		}
	}
} else {



}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wIdth=device-wIdth, initial-scale=1">
    <title>Document</title>
</head>
<body>
    
    
<div class="container">
	<h1>Modification</h1>
	<?=$msg?>

	<form action="#" method="POST" class="row my-5">
		<div class="mb-3">
			<label for="prenom" class="form-label">Nom de la categorie</label>
			<input type="text" class="form-control" placeholder="Nom" name="prenom"
				value="<?=(isset($_GET['Id'])) ? $name : ''?>">
		</div>
		<div class="mb-3">
			<label for="nom" class="form-label">Description</label>


			<textarea class="form-control" placeholder="" name="nom"
				value="<?=(isset($_GET['Id'])) ? $description : ''?>"></textarea>



		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Photo</label>
			<input type="ename" class="form-control" placeholder="" name="name"
				value="<?=(isset($_GET['Id'])) ? $path : ''?>">
		</div>





		<div class="mb-3 col-3">
			<button type="submit" class="btn btn-primary" name="submit">ValIder</button>
			<a class="btn btn-warning" href="index.php" role="button">Retour</a>
		</div>
	</form>

</div>








</body>
</html>