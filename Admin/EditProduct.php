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
$id=$_GET['id'];
$querynume=mysqli_query($db,"select nume from produs where id_produs='$id'");
$qnume=mysqli_fetch_assoc($querynume);
$qqnume=$qnume['nume'];
if(isset($_GET['id']))
{
$id=$_GET['id'];
if(isset($_POST['edit_product']))
{
$numeprod=$_POST['numeprodus'];
$stocprod=$_POST['stocprodus'];
$categorieprod=$_POST['categorieprodus'];
$descriereprod=$_POST['descriereprodus'];
$eticheteprod=$_POST['eticheteprodus'];
$pretprod=$_POST['pretprodus'];
$query=mysqli_query($db,"update produs set nume='$numeprod', stoc='$stocprod' , categorie='$categorieprod' , descriere='$descriereprod' , etichete='$eticheteprod', pret='$pretprod' where id_produs='$id'");
if($query)
{
	header("Location:ToateProdusele.php");
}
else
{
	header("Location:AutentificareAdmin.php");
}
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
                <div class="titleaddproduct">Modifica un produs</div>
            <div class="addproductmenu">
			<?php include('errors.php'); ?>
			<form method="post" action="" enctype="multipart/form-data">
            <input type="text" class="addproductitem" name="numeprodus" placeholder="Numele produsului.." value="<?php echo $qqnume;?>" >
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
            <button type="submit" class="addproductitem" name="edit_product" style="background-color:#001A33;color:white;">Modifica produsul</button>
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