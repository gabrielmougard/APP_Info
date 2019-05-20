<?php

$bdd = new PDO('mysql:host=localhost:3306;dbname=utilisateurCookie;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


if(isset($_COOKIE["statutUtilisateur"]))
{
 header("location:loggedIn.php");
}

$message = '';

if(isset($_POST["connexion"]))
{
 if(empty($_POST["mailUtilisateur"]) || empty($_POST["mdpUtilisateur"]))
 {
  $message = "<div class='alert alert-danger'>Il faut remplir les champs !</div>";
 }
 else
 {
  $query = "SELECT * FROM utilisateur WHERE emailUtilisateur = :emailUtilisateur";
  $data = $bdd->prepare($query);
  $data->bindValue(":emailUtilisateur",$_POST["mailUtilisateur"]);
  $data->execute();

  $count = $data->rowCount();
  if($count > 0)
  {
   $resultat = $data->fetchAll();
   foreach($resultat as $row)
   {
    if(password_verify($_POST["mdpUtilisateur"], $row["mdpUtilisateur"]))
    {
    setcookie("statutUtilisateur", $row["statutUtilisateur"], time()+3600);
    
     
    }
    else
    {
     $message = '<div class="alert alert-danger">Mot de passe incorrect</div>';
    }
   }
  }
  else
  {
   $message = "<div class='alert alert-danger'>Adresse mail incorrecte</div>";
  }
 }
}


?>

<!DOCTYPE html>
<html>
 <head>
  <title>Presentation PHP : Les Cookies</title>
  
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Import shoelace.css -->
  <link rel="stylesheet" href="https://cdn.shoelace.style/1.0.0-beta24/shoelace.css">
       

 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Presentation PHP : Les Cookies</h2>
   <br />
   <div class="panel panel-default">

    <div class="panel-heading">Connexion</div>
    <div class="panel-body">
     <span><?php echo $message; ?></span>
     <form method="post">
      <div class="form-group">
       <label>Email utilisateur</label>
       <input type="text" name="mailUtilisateur" id="mailUtilisateur" class="form-control" />
      </div>
      <div class="form-group">
       <label>Mot de passe</label>
       <input type="password" name="mdpUtilisateur" id="mdpUtilisateur" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" name="connexion" id="connexion" class="btn btn-info" value="Login" />
      </div>
     </form>
    </div>
   </div>
   <br />
   <p>Email : example.php@gmail.com</p>
   <p>Mot de passe : password</p>
  </div>
 </body>
</html>