<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "storescripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$sql = mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($sql)){ 
		$id_produs=$row["id_produs"];
			 $nume = $row["nume"];
			 $stoc = $row["stoc"];
			 $categorie = $row["categorie"];
			 $descriere = $row["descriere"];
			 $etichete = $row["etichete"];
			 $pret= $row["pret"];
			 $data_adaugare= strftime("%b %d, %Y", strtotime($row["data_adaugare"]));
         }
		 
	} else {
		echo "Produsul respectiv nu exista. ";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}
mysql_close();
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Main.css"> 
<link rel="stylesheet" type="text/css" href="Produs.css"> 
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
                        <button class="dropbtncont">Contul meu</button>
                        <div class="dropdowncont-content">
                          <a href="ContulMeu.html">Date personale</a>
                          <a href="Comenzi.html">Comenzile mele</a>
                          <a href="Plata.html">Cardurile mele</a>
                        </div>
                      </div>
                    <a href="HomeWA.html" class="cont">Deconectare</a>
                </div>
                <div class="MandarineM">
                    <div class="logodiv"><img src="Imagini/Logo1.png" class="logo"></div>
                    <img src="Imagini/Cartt.png" class="cart">
                    <a href="Cosc.html" class="cos">Coş de cumpărături</a>
                    
                    <div class="search">
                            <form class="search" action="cautare.php">    
                                    <button type="submit" class="buttonsearch"><i class="fa fa-search"></i></button>
                                    <input type="text" class="searchbar" placeholder="Căutare..">
                                </form> 
                          </div> 
                </div>   
                <div class="toolbar">
                        <a href="HomeA.html" class="tool">Acasă</a>
                        <div class="dropdownprod">
                        <button class="dropbtnprod">Produse</button>
                        <div class="dropdownprod-content">
                                <a href="ProductsAcc.html">Toate produsele</a>
                                <a href="ProductsAcc.html">Produse noi</a>
                                <a href="ProductsAcc.html">Promoţii</a>
                        </div>
                        </div>
                        <a href="AboutAcc.html" class="tool">Despre noi</a>
                        <a href="Contact.html" class="tool">Contact</a>   
                </div>
            </header>
            <div class="box2">
                <div class="produs">
                 <div class="continut-stanga2"><img src="Images/<?php echo $id;?>.jpg" style="box-shadow: 0 4px 50px 0 rgba(20, 13, 65, 0.2)" width="60%"></div>
                 <div class="continut-dreapta2">
                       <div class="titlu-produs"><titlu1><b><?php echo $nume;?></b></titlu1></div>
                       <div class="titlu-descriere"><titlu1><h1><b>Categorie</b></h1><br><p><?php echo $categorie;?></p></titlu1></div><br>
                       <div class="titlu-descriere"><titlu1><h1><b>Descriere produs</b></h1><br><p><?php echo $descriere;?><br>Produsul se vinde doar en-gross, 6 x 2 l.</p></titlu1></div>
                       <br>
                       <div class="titlu-descriere"><titlu1><h1><b>Etichete</b></h1><br><p><?php echo $etichete;?></p></titlu1></div><br>
                       <div class="titlu-descriere"><titlu1><h1><b>Preț</b></h1></titlu1></div>
                       <p class="price2"><b><?php echo $pret;?></b></p>
                       <label for="cantitate" p style="color:#001a33">Cantitate</label>
                       <input type="number" id="cantitate" min="0" name="Cantitate" value="" required color="white" placeholder="Alegeți cantitatea">
                       <div class="card">
                       <p style="margin-top:25px"><button onclick="alert('Produsul a fost adăugat în coșul dumneavoastră de cumpărături')">Adaugă în coș</button></p></div>
                       <br><br>
                         </div>
 
                </div>    
         </div> 
<div class="footer">
    <div class="footer-menu">
           <div class="item-footer-menu"><a href="HomeA.html">Acasă</a></div>
           <div class="item-footer-menu"> <a href="ProductsAcc.html" >Produse</a></div>
           <div class="item-footer-menu"><a href="Contact.html" >Contact</a></div>
    </div>
    <div class="rightstext">
        <p class="rights">&copy;Toate drepturile sunt rezervate.</p>
    </div>
        <div class="VisaMaster">
        <img src="Imagini/master.png" class="plati">
        <img src="Imagini/visa.png" class="plati">
        </div>

</div>
</div>
    </body>
</html>