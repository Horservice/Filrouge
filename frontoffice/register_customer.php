<?php
try{
    //se connecte a MySQL
    $db = new PDO ('mysql:host=localhost;dbname=filrouge;charset=utf8','root','');

} catch (Exception $e) {
    //en cas d'erreur
        die('Erreur : ' .$e->getMessage());

}


var_dump($_POST);
$msg1="";
$msg2="";
if(isset($_POST['submit'])){

    if (!isset($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    || (!isset($_POST['lastname']) || empty($_POST['lastname']))
    || (!isset($_POST['firstname']) || empty($_POST['firstname']))
    || (!isset($_POST['password']) || empty($_POST['password']))
    || (!isset($_POST['billing_address']) || empty($_POST['billing_address']))
    || (!isset($_POST['delivery_address']) || empty($_POST['delivery_address']))
    || (!isset($_POST['identifier']) || empty($_POST['identifier']))

    ){
        
        $msg1="tout les champs doit être remplit sinon ça marche pas !";

    } else {


        $email = $_POST['email'];
        $lastname = strip_tags($_POST['lastname']);
        $firstname= strip_tags($_POST['firstname']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $biling = strip_tags($_POST['billing_address']);
        $delivery = strip_tags($_POST['delivery_address']);
        $identifier = strip_tags($_POST['identifier']);
        


		$query = 'INSERT INTO `customer`(`identifier`, `firstname`, `lastname`, `email`, `password`, `billing_address`, `delivery_address`) 
        VALUES (:identifier, :firstname, :lastname, :email, :password, :billing_address, :delivery_address)';



		$req = $db->prepare($query);
		$req->bindValue(':firstname', $firstname, PDO::PARAM_STR);
		$req->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->bindValue(':password', $password, PDO::PARAM_STR);
        $req->bindValue(':billing_address', $biling, PDO::PARAM_STR);
        $req->bindValue(':delivery_address', $delivery, PDO::PARAM_STR);
        $req->bindValue(':identifier', $identifier, PDO::PARAM_STR);
		$req->execute();
		$msg2='<h2 class="my-5 text-success">customer ajouté.</h2>';

        
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
<style>
#t{

    margin-top: 25px;

}

</style>
<body>
<main>
    <div class="row w-100" style="height:calc(100vh - 60px);">
    <form class="col-3 m-auto" action="#" method="POST">
        <h1 class="h3 mb-3 fw-normal">Ajouter un nouveau admin</h1>
        <h4><?=$msg1?><?=$msg2?></h4>
        <div>
        <label for="email">Email address</label>
            <input type="email" class="form-control" placeholder="exemple@live.fr" name="email">
        </div>
        <div>
        <label for="firstname">Prénom</label>
            <input type="text" class="form-control" placeholder="Votre prélastname" name="firstname" >
        </div>

        <div>
        <label for="lastname">Famille</label>

            <input type="text" class="form-control" placeholder="Votre lastname" name="lastname">
        </div>

        <div>
        <label for="password">Mot de passe</label>

            <input type="password" class="form-control" placeholder="Mot de passe" name="password" >
        </div>

               
        <div>
        <label for="billing_address">adress1 </label>

            <input type="text" class="form-control" placeholder="Votre lastname" name="billing_address">
        </div>

               
        <div>
        <label for="delivery_address">adress2</label>

            <input type="text" class="form-control" placeholder="Votre lastname" name="delivery_address">
        </div>

        <div>
        <label for="identifier">identifier</label>

            <input type="text" class="form-control" placeholder="identifier" name="identifier">
        </div>



        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" id="t">ajouter </button>
    </form>
</div>

    </main>

</body>
</html>