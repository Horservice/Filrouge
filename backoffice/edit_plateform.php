
<?php
var_dump($_GET);

$msg="";
if(isset($_GET['Id'])) {
	$id = strval($_GET['Id']);
    $query = 'SELECT * FROM plateforms WHERE Id = :Id';
	$req = $db->prepare($query);
	$req->bindValue(':Id', $id, PDO::PARAM_INT);
	$req->execute();
	$plateforms = $req->fetch();

	$name = $plateforms['name'];


	if(isset($_POST['submit'])){
		if (!isset($_POST['name']) || empty($_POST['name'])){
			
		echo 'Il faut faut remplir tous les champs pour soumettre le formulaire.';
			exit;
		} else {
            
			$name = strip_tags($_POST['name']);
            $id = strval($_GET['Id']);

	
			$query = 'UPDATE plateforms SET name = :name WHERE Id = :Id';
			$req = $db->prepare($query);
			$req->bindValue(':name', $name, PDO::PARAM_STR);
			$req->bindValue(':Id', $id, PDO::PARAM_INT);
			$req->execute();
			$msg=$msg='<h3 class="my-5 text-warning">Informations modifiées.</h3>';
		}
	}
} else {
	// header('Location: index.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    




<div class="container">
	<h1>Modification</h1>
	<?=$msg?>

	<form action="#" method="POST" class="row my-5">
		<div class="mb-3">
			<label for="name" class="form-label">Nom</label>
			<input type="text" class="form-control" placeholder="Nom" name="name"
				value="<?=(isset($_GET['Id'])) ? $name : ''?>">
		</div>

		<div class="mb-3 col-3">
			<button type="submit" class="btn btn-primary" name="submit">Valider</button>
			<a class="btn btn-warning" href="index.php?page=management_plateform" role="button">Retour</a>
		</div>
	</form>

</div>




















</body>
</html>