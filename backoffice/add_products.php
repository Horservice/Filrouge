<?php
try{
	// On se connecte à MySQL
	$db = new PDO('mysql:host=localhost;dbname=filrouge;charset=utf8', 'root', '');
}
catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


//a switche plus tard id_category la on teste//
$query1= 'SELECT * FROM sub_category WHERE Id between 1 and 3';
$req1 = $db->prepare($query1);
$req1->execute();
$sub_categorys = $req1->fetchAll(PDO::FETCH_ASSOC);


$query3= 'SELECT * FROM sub_category WHERE Id between 4 and 6';
$req3 = $db->prepare($query3);
$req3->execute();
$sub_categorys1 = $req3->fetchAll(PDO::FETCH_ASSOC);


$query4= 'SELECT * FROM sub_category WHERE Id between 7 and 9';
$req4 = $db->prepare($query4);
$req4->execute();
$sub_categorys2 = $req4->fetchAll(PDO::FETCH_ASSOC);



$query2= 'SELECT * FROM plateforms ';
$req2 = $db->prepare($query2);
$req2->execute();
$plateforms = $req2->fetchAll(PDO::FETCH_ASSOC);




$msg1="";
$msg2="";

if(isset($_POST['submit'])){

    if (!isset($_POST['identifier']) || empty($_POST['identifier'])
    || (!isset($_POST['name']) || empty($_POST['name']))
    || (!isset($_POST['description']) || empty($_POST['description']))
    || (!isset($_POST['price']) || empty($_POST['price']))
    || (!isset($_FILES['photo']) || empty($_FILES['photo']))
    // || (!isset($_POST['Id_plateforms']) || empty($_POST['Id_plateforms']))
    // || (!isset($_POST['Id_category']) || empty($_POST['Id_category']))
    // || (!isset($_POST['Id_sub_category']) || empty($_POST['Id_sub_category']))
     ){
        
    $msg1='tout les champs doit etre remplit .';
    } else {



        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

            if ($_FILES['photo']['size'] <= 1000000) {
            
                $fileInfo = pathinfo($_FILES['photo']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($extension, $allowedExtensions)) { 



                    $identifier = strip_tags($_POST['identifier']);
                    $name = strip_tags($_POST['name']);
                    $description= strip_tags($_POST['description']);
                    $price = strip_tags($_POST['price']);
                    $isEnable = strip_tags($_POST['is_enable']);
                    $plateforms = ($_POST['Id_plateforms']);
                    $subCategory = ($_POST['Id_sub_category']);



                    move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($_FILES['photo']['name']));
                    $screenshot = 'uploads/' . basename($_FILES['photo']['name']);

                    $query = 'INSERT INTO products(identifier, name, description, price, path, is_enable, Id_plateforms, Id_sub_category, Id_category)
                              VALUES (:identifier, :name, :description, :price, :path, :is_enable, :Id_plateforms, :Id_sub_category, :Id_category )';
                    $req = $db->prepare($query);
                    
                    $req->bindValue(':identifier', $identifier, PDO::PARAM_STR);
                    $req->bindValue(':name', $name, PDO::PARAM_STR);
                    $req->bindValue(':description', $description, PDO::PARAM_STR);
                    $req->bindValue(':price', $price, PDO::PARAM_STR);
                    $req->bindValue(':path',$screenshot , PDO::PARAM_STR);
                    $req->bindValue(':is_enable', $isEnable, PDO::PARAM_STR);






                    
                    
                    
                    
                    $req->bindValue(':Id_plateforms', $plateforms, PDO::PARAM_STR);
                    
                    
                    
                    
                    $req->bindValue(':Id_sub_category', $subCategory, PDO::PARAM_STR);













                    $req->execute();
                    $msg2="nouveaux catégorie ajoute a la base de donnée.";





                } else {
                    echo 'Le format du fichier n\'est pas autorisé. Merci de n\'envoyer que des fichiers .jpg, .jpeg, .png ou .gif';
            
                    exit;
                }
            } else {
                echo 'Le fichier dépasse la taille autorisée';
                exit;
            }
        } else {
        echo 'Le fichier n\'a pas été envoyé correctement';
        exit;
        }

    }
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    

<div class="container">       
<h4><?=$msg1?><?=$msg2?></h4>

        <form action="" method="POST" class="row my-5" enctype="multipart/form-data">


            <div class="mb-3">
                <label for="identifier" class="form-label">identifier</label>
                <input type="text" class="form-control"  name="identifier">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">name</label>
                <input type="text" class="form-control"  name="name">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
          

            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" class="form-control"  name="price">
            </div>
            
                    
            <div class="mb-3">
                <label for="path" class="form-label">Photo</label>
                <input type="file" class="form-control"  name="photo">
            </div>                                  <!-- name="photo" =  $_FILES['photo '] -->
           

            <div class="mb-3">
                <label for="is_enable_on" class="form-label">Disponible</label>
                <input type="radio" class="form-control"  name="is_enable" value="1">

                <label for="is_enable_off" class="form-label">Non Disponible</label>
                <input type="radio" class="form-control"  name="is_enable" value="0">
            </div>



            <div class="mb-3">
                <label for="Id_plateforms" class="form-label">Plateforme</label>
                <select name="Id_plateforms">
                    <?php
                    foreach ($plateforms as $plateform) {
                    ?>
                        <option value="<?= $plateform['Id'] ?>"><?= $plateform['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>




                    
            
            <div class="mb-3">
                <label for="Id_sub_category" class="form-label">Sous Catégorie</label>
                <select name="Id_sub_category">
                    <optgroup label="rpg ">
                    

                        <?php
                        foreach ($sub_categorys as $sub_category) {
                        ?>
                            <option value="<?= $sub_category['Id'] ?>"><?= $sub_category['name'] ?></option>
                        <?php
                        }
                        ?>







                        
                    </optgroup>
                    
                    <optgroup label="rpg ">
                    

                        <?php
                        foreach ($sub_categorys1 as $sub_category1) {
                        ?>
                            <option value="<?= $sub_category1['Id'] ?>"><?= $sub_category1['name'] ?></option>
                        <?php
                        }
                        ?>







                        
                    </optgroup>
                    
                                        
                    <optgroup label="rpg ">
                    

                        <?php
                        foreach ($sub_categorys2  as $sub_category2 ) {
                        ?>
                            <option value="<?= $sub_category2 ['Id'] ?>"><?= $sub_category2 ['name'] ?></option>
                        <?php
                        }
                        ?>




                        
                    </optgroup>

                </select>
            </div>



            <div class="mb-3 col-3">
                <button type="submit" class="btn btn-primary" name="submit">Valider</button>
            </div>



        </form>
    </div>



</body>
</html>