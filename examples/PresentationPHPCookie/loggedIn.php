
<?php
//loggedIn.php

if(!isset($_COOKIE["etat"]))
{
 header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Presentation PHP : les Cookies</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Import shoelace.css -->
  <link rel="stylesheet" href="https://cdn.shoelace.style/1.0.0-beta24/shoelace.css">
   
</head>
<body>
  <br />
  <div class="container">
   <h2 align="center">Presentation PHP : les Cookies</h2>
   <br />
   <div align="right">
    <a href="deconnexion.php">Déconnexion</a>
   </div>
   <br />
   <?php
   if(isset($_COOKIE["etat"]))
   {
    echo '<h2 align="center">Bienvenue !</h2>';
   }
   ?>
  </div>
 </body>
</html>

