<?php    

    try{
        // On se connecte à MySQL
        $db = new PDO('mysql:host=localhost;dbname=filrouge;charset=utf8', 'root', '');
    }
    catch(Exception $e){
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }


    $sql = 'SELECT * FROM `category`  ';
    $query = $db->prepare($sql);
    $query->execute();
    $categorys = $query->fetchAll(PDO::FETCH_ASSOC);


    $msg1="";
    $msg2="";

    if(isset($_POST['submit'])){
    
        if (!isset($_POST['name']) || empty($_POST['name'])
        || (!isset($_POST['description']) || empty($_POST['description']))){
            
        $msg1='tout les champs doit etre remplit .';



        } else {
 
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

                if ($_FILES['photo']['size'] <= 1000000) {
                
                    $fileInfo = pathinfo($_FILES['photo']['name']);
                    $extension = $fileInfo['extension'];
                    $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                    if (in_array($extension, $allowedExtensions)) { 

                        $name = strip_tags($_POST['name']);
                        $description= strip_tags($_POST['description']);
                        $id_category = strip_tags($_POST['categories']);
            
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($_FILES['photo']['name']));
                        $screenshot = 'uploads/' . basename($_FILES['photo']['name']);
                        $query = 'INSERT INTO sub_category(name, description, path, Id_category) VALUES (:name, :description, :path, :Id_category)';
                        $req = $db->prepare($query);
                        $req->bindValue(':name', $name, PDO::PARAM_STR);
                        $req->bindValue(':description', $description, PDO::PARAM_STR);
                        $req->bindValue(':path',$screenshot , PDO::PARAM_STR);
                        $req->bindValue(':Id_category', $id_category, PDO::PARAM_STR);


                        
                        $req->execute();
                        $msg2="nouveaux sous-categorie ajoute a la base de donnée.";

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
                <label for="name" class="form-label">name</label>
                <input type="text" class="form-control"  name="name">
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
          
                    
            <div class="mb-3">
                <label for="path" class="form-label">path</label>
                <input type="file" class="form-control"  name="photo">
            </div>                                       <!-- name="photo" =  $_FILES['photo'] -->
           
            <div class="mb-3">
            <label for="definition" class="form-label">choisir la catégorie</label>
            <select name="categories">
                <?php
                foreach ($categorys as $category) {
                ?>
                    <option value="<?= $category['Id'] ?>"><?= $category['name'] ?></option>
                <?php
                }
                ?>
            </select>
            </div>
          
            <div class="mb-3 col-3">
                <button type="submit" class="btn btn-primary" name="submit">Valider</button>
            </div>

        </form>
    </div>
</body>
</html>