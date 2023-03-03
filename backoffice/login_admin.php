<?php
try{
    //se connecte a MySQL
    $db = new PDO ('mysql:host=localhost;dbname=filrouge;charset=utf8','root','');

} catch (Exception $e) {
    //en cas d'erreur
        die('Erreur : ' .$e->getMessage());

}
session_start();

// si aucun soucis on continue
$msg='';
$msg1='';
$msg2='';
if(isset($_POST['submit'])){
    //si champ vide ou pas remplis 
    if (!isset($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    || (!isset($_POST['lastname']) || empty($_POST['lastname']))
    || (!isset($_POST['firstname']) || empty($_POST['firstname']))
    || (!isset($_POST['password']) || empty($_POST['password']))
    ){
        $msg="tout les champs doit être remplit sinon ça marche pas !";

    } else { 

        
        $email = $_POST['email'];
        $lastname = strip_tags($_POST['lastname']);
        $firstname = strip_tags($_POST['firstname']);
        $password = htmlspecialchars($_POST['password']);

        $_SESSION['email'] = $email;
        $_SESSION['lastname'] =$lastname;
        $_SESSION['firstname'] =$firstname;
        

    }

    $query = 'SELECT * FROM admin WHERE email = :email';
    $req = $db->prepare($query);
	$req->bindValue(':email', $email, PDO::PARAM_STR);
	$req->execute();
    $data = $req->fetch();
    


    if (password_verify($password,$data['password'])){


        header("Location: index_admin.php");
        
        $msg1='Le mot de passe est valide !';
    } else {

        $msg2='Le mot de passe est invalide !';
    }




}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46Mglastname80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
    <form class="col-3 m-auto" action="" method="POST">
        <h1 class="h3 mb-3 fw-normal">Connectez-vous</h1>
        <h4><?=$msg?></h4>
        <div>
        <label for="email">Email address</label>
            <input type="email" class="form-control" placeholder="exemple@live.fr" name="email">
        </div>
        <div>
        <label for="firstname">prénom</label>
            <input type="text" class="form-control" placeholder="Votre prélastname" name="firstname" >
        </div>
        <div>
        <label for="lastname">nom de famille</label>

            <input type="text" class="form-control" placeholder="Votre lastname" name="lastname">
        </div>
        <div>
        <label for="lastname">Mot de passe</label>

            <input type="password" class="form-control" placeholder="********" name="password" >
            <h5><?=$msg1?></h5><h5><?=$msg2?></h5>

        </div>


        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" id="t">Se connecter</button>
    </form>
</div>

    </main>
</body>
</html>