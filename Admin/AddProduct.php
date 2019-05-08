<?php 

  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Trebuie sa fiti logat!";
  	header('location: AutentificareAdmin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: AutentificareAdmin.php");
  }
    $msg = "";
  $id_prod = "";
  $numeprod = "";
  $pretprod = "";
  $cantitateprod = "";
  $categorieprod = "";
  $descriereprod = "";
  $imagineprod = "";
  $eticheteprod = "";
  $errors = array();

define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'EchipaRacheta');
define('DB_DATABASE', 'juicy');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (isset($_POST['add_product'])) {
  $numeprod = mysqli_real_escape_string($db, $_POST['numeprodus']);
  $pretprod = mysqli_real_escape_string($db, $_POST['pretprodus']);
  $cantitateprod = mysqli_real_escape_string($db, $_POST['stocprodus']);
  $categorieprod = mysqli_real_escape_string($db, $_POST['categorieprodus']);
  $descriereprod = mysqli_real_escape_string($db, $_POST['descriereprodus']);
  $eticheteprod = mysqli_real_escape_string($db, $_POST['eticheteprodus']);
  $dataprod = mysqli_real_escape_string($db, $_POST['dataprodus']);
  $imagineprod = $_FILES['imagine-produs']['name'];
  
  if (empty($numeprod)) { array_push($errors, "Nume produs obligatoriu"); }
  if (empty($pretprod)) { array_push($errors, "Pret produs obligatoriu"); }
  if (empty($cantitateprod)) { array_push($errors, "Cantitate obligatorie"); }
  if (empty($categorieprod)) { array_push($errors, "Categorie produs obligatorie"); }
  if (empty($descriereprod)) { array_push($errors, "Descriere produs obligatorie"); }
   
 
  $product_check_query = "SELECT * FROM produs WHERE nume='$numeprod' LIMIT 1";
  $result = mysqli_query($db, $product_check_query);
  $prod = mysqli_fetch_assoc($result);
  
  if ($prod) { // if product exists
    
    if ($prod['nume'] === $numeprod) {
      array_push($errors, "Exista deja un produs cu acest nume in baza de date!");
    }
  }
  $imagine_check_query = "SELECT * FROM imagini WHERE numepoza='$imagineprod' LIMIT 1";
  $result_imagine = mysqli_query($db, $imagine_check_query);
  $imag = mysqli_fetch_assoc($result_imagine);
  
  if ($imag) { // if product exists
    
    if ($imag['numepoza'] === $imagineprod) {
      array_push($errors, "Exista deja o poza cu acest nume in baza de date!");
    }
  }
  if (count($errors) == 0) {
  	
	$query1 = "INSERT INTO produs (nume, stoc, categorie, descriere,etichete,pret,data_adaugare) 
  			  VALUES('$numeprod','$pretprod', '$categorieprod', '$descriereprod', '$eticheteprod', '$pretprod', '$dataprod')";
  	mysqli_query($db, $query1);
	
	$id_prod_query = "select id_produs from produs where nume='$numeprod'";
	$result_id_prod = mysqli_query($db,$id_prod_query);
	$id_prod = mysqli_fetch_assoc($result_id_prod);
	$id_produs_imagini = $id_prod["id_produs"];
	 $caleimagine = "poze_produse/".basename($imagineprod);
	 $query2 = "INSERT INTO imagini (id_produs, numepoza) VALUES ('$id_produs_imagini', '$imagineprod')";
	mysqli_query($db, $query2);
	 if (move_uploaded_file($_FILES['imagine-produs']['tmp_name'], $caleimagine)) {
  		array_push($errors,"Imaginea a fost incarcata cu succes!");
  	}else{
  		array_push($errors,"Imaginea nu a putut fi incarcata!");
  	}
	 	header('location: MainAdmin.php');
	}
  }
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Addproduct.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="Ico1.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DESC Company</title>
</head>
<body style="background-color:#F9F9F9">
        <div class="container">
        <header>
                <div class="utilizator">
                    <div class="dropdowncont">
                        <button class="dropbtncont">Optiuni Admin</button>
                        <div class="dropdowncont-content">
                          <a href="AddProduct.php">Adauga produs</a>
                          <a href="ToateProdusele.php">Lista produse</a>
						   <a href="Carduri.html">Centru mesaje</a>
                        </div>
                      </div>
                    <a href="AutentificareAdmin.php" class="cont">Deconectare</a>
                </div>
                <div class="MandarineM">
				<div class="AdminMesaj">
								<?php  if (isset($_SESSION['username'])) : ?>
    	<p>Bine ai venit, <strong><?php echo $_SESSION['username']; ?></strong></p>
					<?php endif ?>
					<?php if (isset($_SESSION['success'])) : ?>
 
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
  	<?php endif ?>
					</div>
                    <div class="logodiv"><img src="Logo1.png" class="logo"></div> 
                    <div class="search">
                            <form class="search" action="cautare.php">    
                                    <button type="submit" class="buttonsearch"><i class="fa fa-search"></i></button>
                                    <input type="text" placeholder="Căutare.." class="searchbar">
                                </form> 
                          </div> 
                </div>   
                <div class="toolbar">
                        <a href="Acasa.html" class="tool">Acasă</a>
                        <div class="dropdownprod">
                        <button class="dropbtnprod">Produse</button>
                        <div class="dropdownprod-content">
                                <a href="Toateprodusele.html">Toate produsele</a>
                                <a href="Produsenoi.html">Produse noi</a>
                                <a href="Promotii.html">Promoţii</a>
                        </div>
                        </div>
                        <a href="Despre.html" class="tool">Despre noi</a>
                        <a href="Contact.html" class="tool">Contact</a>   
                </div>
            </header>
            <div class="box">
                <div class="titleaddproduct">Adauga un produs</div>
            <div class="addproductmenu">
			<?php include('errors.php'); ?>
			<form method="post" action="AddProduct.php" enctype="multipart/form-data">
            <input type="text" class="addproductitem" name="numeprodus" placeholder="Numele produsului.." >
            <br>
            <input type="text" class="addproductitem" name="stocprodus" placeholder="Stocul produsului.." >
			<br>
			<input type="text" class="addproductitem" name="categorieprodus" placeholder="Categorie produs..">
            <br>
            <textarea cols="40" rows="5" class="addproductitem" name="descriereprodus" placeholder="Descriere produs.."></textarea>
			<br>
			<input type="text" class="addproductitem" name="eticheteprodus" placeholder="Etichete produs..">
			<br>
            <input type="text" class="addproductitem" name="pretprodus" placeholder="Pretul produsului.." >
            <br>
			<label class="addproductitem">Data adaugare produs</label>
			<br>
            <input type="date" class="addproductitem" name="dataprodus"  min="2019-01-01" max="2025-12-31">
            <br>
            <input type="file" class="addproductitem" name="imagine-produs" accept="image/*">
			<br>
            <button type="submit" class="addproductitem" name="add_product" style="background-color:#001A33;color:white;">Adaugare produs</button>
			</form>
            </div>
            </div>
<div class="footer">
    <div class="footer-menu">
           <div class="item-footer-menu"><a href="HomeA.html">Acasă</a></div>
           <div class="item-footer-menu"> <a href="Produse.html" >Produse</a></div>
           <div class="item-footer-menu"><a href="Contact.html" >Contact</a></div>
    </div>
    <div class="rightstext">
        <p class="rights">&copy;Toate drepturile sunt rezervate.</p>
    </div>
        <div class="VisaMaster">
        <img src="master.png" class="plati">
        <img src="visa.png" class="plati">
        </div>

</div>
</div>
    </body>
</html>