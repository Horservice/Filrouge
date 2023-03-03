<?php
try{
	// On se connecte à MySQL
	$db = new PDO('mysql:host=localhost;dbname=filrouge;charset=utf8', 'root', '');
}
catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}




$title="Back-Office";
if(isset($_GET['page']) && $_GET['page'] !=NULL) { 
	$page = strval($_GET['page']);
	
	if($page == "homepage_admin") {
		$title="Back-Office";
		$inc= 'homepage_admin.php';
		}
	else if($page == "usersAdd") {
		$title="UserAdd";
		$inc= 'usersAdd.php';
		} 
	else if($page == "usersEdit") {
		$title="UserEdit";
		$inc= 'usersEdit.php';
		}  
		
	else {
		$inc= 'users.php';
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
	<title><?=$title?></title>
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
          <a class="nav-link active" aria-current="page" href="index.php?page=homepage_admin"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=usersAdd">Gestion des Catégories</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="index.php?page=usersEdit">Gestion des Sous_catégories</a>
        </li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=">Gestion de la plateforme</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=usersEdit">Gestion des produit</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=usersEdit">Gestion des Admin</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=usersEdit">Quitter</a>
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