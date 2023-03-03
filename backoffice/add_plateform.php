<?php
try{
    //se connecte a MySQL
    $db = new PDO ('mysql:host=localhost;dbname=filrouge;charset=utf8','root','');

} catch (Exception $e) {
    //en cas d'erreur
        die('Erreur : ' .$e->getMessage());

}



$msg1="";
$msg2="";
if(isset($_POST['submit'])){

    if (!isset($_POST['name']) || empty($_POST['name']))
    {    
        $msg1="tout les champs doit être remplit sinon ça marche pas !";
s
    } else {
        $name = strip_tags($_POST['name']);
        
		$query = 'INSERT INTO plateforms (name) VALUES (:name)';
		$req = $db->prepare($query);
		$req->bindValue(':name', $name, PDO::PARAM_STR);
		$req->execute();
		$msg2='<h2 class="my-5 text-success">Nouveau plateforme ajouté.</h2>';


        
	}
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
<h4><?=$msg1?><?=$msg2?></h4>

    <form action="#" method="POST" class="row my-5" enctype="multipart/form-data">

            <div class="mb-3 col-3">
                <label for="name">Nom de la plateform</label>
                 <input type="text" class="form-control" placeholder="" name="name" >
            </div>
            
            <div class="mb-3 col-3">
                <button type="submit" class="btn btn-primary" name="submit">Valider</button>
            </div>

    </form>
    
</body>
</html>