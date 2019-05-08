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
   
  $errors = array();

define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'EchipaRacheta');
define('DB_DATABASE', 'juicy');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

$sql = "SELECT * from produs";

$records = mysqli_query($db,$sql);

if(isset($_GET['id']))
{
$id=$_GET['id'];
$query1=mysqli_query($db,"delete from produs where id_produs='$id'");
$query2=mysqli_query($db,"delete from imagini where id_produs='$id'");
if($query1 && $query2)
{   
	header("Location:ToateProdusele.php");
	exit();
}
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="ToateProdusele2.css"> 
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
                <div class="titleallproducts">Toate produsele</div>
       
			<?php include('errors.php'); ?>
			<table id="tabelproduse">
			<tr>
			<th>ID produs</th>
			<th>Nume produs</th>
			<th>Stoc</th>
			<th>Categorie</th>
			<th>Descriere</th>
			<th>Etichete</th>
			<th>Pret</th>
			<th>Data adaugare</th>
			<tr>
			<?php
			  
			  while($produse=mysqli_fetch_assoc($records)){
				  
				  echo "<tr>";
				  
				  echo "<td method=post>".$produse['id_produs']."</td>";
				  
				  echo "<td method=post>".$produse['nume']."</td>";
				  
				  echo "<td method=post>".$produse['stoc']."</td>";
				  
				  echo "<td method=post>".$produse['categorie']."</td>";
				  
				  echo "<td method=post>".$produse['descriere']."</td>";
				  
				  echo "<td method=post>".$produse['etichete']."</td>";
				  
				  echo "<td method=post>".$produse['pret']."</td>";
				  
				  echo "<td method=post>".$produse['data_adaugare']."</td>";
				  
				  echo "<td><a href='ToateProdusele.php?id=".$produse['id_produs']."'>Sterge</td>";
				  
				  echo "<td><a href='EditProduct.php?id=".$produse['id_produs']."'>Modifica</td>";
				  
				  echo "<td><form method=post><button type=submit name=promote_prod>Adauga la promotii</button></form></td>";
				  
				  echo "</tr>";
			  }
				  
			?>
			</table>
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