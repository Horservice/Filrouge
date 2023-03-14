<?php
try{
	// On se connecte à MySQL
	$db = new PDO('mysql:host=localhost;dbname=filrouge;charset=utf8', 'root', '');
}
catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

session_start();

if(isset($_GET['action']) && $_GET['action'] == "signout"){
	session_destroy();
	header('location: login_admin.php');
}





if(isset($_GET['page']) && $_GET['page'] !=NULL) { 
	$page = strval($_GET['page']);
	
	if($page == "homepage_admin") {
		$inc= 'homepage_admin.php';
		}
	else if($page == "management_category") {
		$inc= 'management_category.php';
		}
		else if($page == "management_picture") {
			$inc= 'management_picture.php';
			}
			else if($page == "management_plateform") {
				$inc= 'management_plateform.php';
				}
				else if($page == "management_products") {
					$inc= 'management_products.php';
					}
					else if($page == "management_sub_category") {
						$inc= 'management_sub_category.php';
						}
						else if($page == "management_admin") {
							$inc= 'management_admin.php';
							}
							else if($page == "add_admin") {
								$inc= 'register_admin.php';
								}
								else if($page == "add_category") {
									$inc= 'add_category.php';
									}
									else if($page == "add_sub_category") {
										$inc= 'add_sub_category.php';
										}
									else if($page == "add_plateform") {
										$inc= 'add_plateform.php';
										}
										else if($page == "add_products") {
											$inc= 'add_products.php';
											}
											else if($page == "edit_category") {
												$inc= 'edit_category.php';
												}
												else if($page == "edit_plateform") {
													$inc= 'edit_plateform.php';
													}

								
		











	else {
		$inc= 'homepage_admin.php';
		}
	}
else {
	$inc= 'homepage_admin.php';
	}

?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Back Office</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Back-Office</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-automb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?page=homepage_admin">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=management_category">Gestion des Catégories</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="index.php?page=management_sub_category">Gestion des Sous_catégories</a>
        </li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=management_plateform">Gestion de la plateforme</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=management_products">Gestion des produit</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=management_admin">Gestion des Admin</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?action=signout">Quitter</a>
		</li>
      </ul>
    </div>
  </div>
</nav>
</header>
<main>


	<?php 
		include("$inc");
	?>
	
</main>	
</body>

</html>