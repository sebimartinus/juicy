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
  $nume = mysqli_real_escape_string($db, $_POST['nume']);
  $prenume = mysqli_real_escape_string($db, $_POST['prenume']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($nume)) { array_push($errors, "Nume obligatoriu"); }
  if (empty($prenume)) { array_push($errors, "Prenume obligatoriu"); }
  if (empty($email)) { array_push($errors, "Email obligatoriu"); }
  if (empty($password_1)) { array_push($errors, "Parola obligatorie"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Parolele nu coincid!");
  }

  $user_check_query = "SELECT * FROM administrator WHERE nume='$nume' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    
    if ($user['email'] === $email) {
      array_push($errors, "Emailul exista deja in baza de date!");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO administrator (nume, prenume,email,parola) 
  			  VALUES('$nume','$prenume', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $email;
	$_SESSION['prenume'] = $prenume;
  	$_SESSION['success'] = "Acum sunteti logat";
  	header('location: MainAdmin.php');
  }
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
  } ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CreateAdmin2.css">  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="Ico1.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Creare cont admin</title>
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
                        <a href="AboutAcc.html" class="tool">Despre noi</a>
                        <a href="Contact.html" class="tool">Contact</a>   
                </div>
            </header>
            <div class="creare-cont" >
                <form method="post" action="CreateAdmin.php">
				<?php include('errors.php'); ?>
                    <div class="titlucont">Creare cont administrator </div>
                    
                    <hr></hr>

                    <div class="text">
                        <p><b>Vă rugăm să completați spațiile pentru crearea contului.</b></p>
                    </div>

                    <label for="nume"><b>Nume</b></label>
                   <input type="text" name="nume" class="creare" placeholder="Nume" value="<?php echo $username; ?>">

                    <label for="prenume" ><b>Prenume</b></label> 
                    <input type="text" name="prenume" class="creare" placeholder="Prenume" value="<?php echo $username; ?>">

                    <label for="email" ><b>Email</b></label>
                    <input type="email" name="email"  class="creare" placeholder="Email" value="<?php echo $email; ?>">
        
                    <label for="parola" ><b>Parola</b></label>   
                   <input type="password" name="password_1" class="creare" >

                    <label for="parolaconf" ><b>Confirmare parola</b></label>
                    <input type="password" name="password_2" class="creare">

                    <button type="submit" class="butoncreare" name="reg_user">Inregistrare</button>
                
                </form>
            </div>  
    </div>
    <div class="footer">
        <div class="footer-menu">
               <div class="item-footer-menu"><a href="HomeA.html">Acasă</a></div>
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