<?php session_start();


$username = "";
$email    = "";
$errors = array(); 


define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'EchipaRacheta');
define('DB_DATABASE', 'juicy');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


if (isset($_POST['reg_user'])) {
  header('location: AutentificareAdmin.php');
}
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($email)) {
        array_push($errors, "Completati adresa de email!");
    }
    if (empty($password)) {
        array_push($errors, "Completati parola!");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM administrator WHERE email='$email' AND parola='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $email;
          $_SESSION['success'] = "Logare realizata cu succes!";
          header('location: MainAdmin.php');
        }else {
            array_push($errors, "Combinatia parola-email este gresita!");
        }
    }
  }?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="AutentificareAdmin.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="Ico1.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Autentificare Admin</title>
</head>
<body style="background-color:#F9F9F9">
        <div class="container">
        <header>
                <div class="utilizator">
                      <a href="AutentificareAdmin.php" class="cont">Conectare</a>
                    <a href="CreateAdmin.php" class="cont">Creare cont</a>
                </div>

                <div class="MandarineM">
                    <div class="logodiv"><img src="Logo1.png" class="logo"></div>
                    <div class="search">
                            <form class="search" action="cautare.php">    
                                    <button type="submit" class="buttonsearch"><i class="fa fa-search"></i></button>
                                    <input type="text" class="searchbar" placeholder="Căutare..">
                                </form> 
                          </div> 
                </div>   
                <div class="toolbar">
                        <a href="HomeWA.html" class="tool">Acasă</a>
                        <div class="dropdownprod">
                                <button class="dropbtnprod">Produse</button>
                                <div class="dropdownprod-content">
                                        <a href="ProductsWA.html">Toate produsele</a>
                                        <a href="ProductsWA.html">Produse noi</a>
                                        <a href="ProductsWA.html">Promoţii</a>
                                </div>
                                </div>
                        <a href="AboutWA.html" class="tool">Despre noi</a>
                        <a href="Contact.html" class="tool">Contact</a>   
                </div>
            </header>
            <div class="autentificare" >
                 <form method="post" action="AutentificareAdmin.php">
				<?php include('errors.php'); ?>
                    <div class="titlucont">Autentificare administrator</div>

                    <div class="text">
                        <p><b>Vă rugăm să completați spațiile pentru a vă autentifica.</b></p>
                    </div>
                    
                    <label for="email" ><b>Email</b></label> 
                    <input type="email" id="email" name="email" class="creare"  maxlength="255" placeholder="Email"  required>
        
                    <label for="parola" ><b>Parola</b></label>   
                    <input type="password" name="password" id="parola" class="creare"placeholder="Parola" required>
        
                    <input type="checkbox"> <b>Păstreaza-mă autentificat.</b>
                    <div class="clasa-buton">
                        <button type="submit" class="butoncreare" name="login_user">Login</button>
                    </div>
						<p>
  		Nu aveti cont? <a href="CreateAdmin.php">Creati unul acum.</a>
  	</p>
                </form>
            </div>   
    </div>
    <div class="footer">
        <div class="footer-menu">
               <div class="item-footer-menu"><a href="HomeWA.html">Acasă</a></div>
               <div class="item-footer-menu"> <a href="ProductsWA.html" >Produse</a></div>
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