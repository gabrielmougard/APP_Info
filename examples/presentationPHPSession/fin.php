<?php
session_start();
?>
<!DOCTYPE=html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Import shoelace.css -->
        <link rel="stylesheet" href="https://cdn.shoelace.style/1.0.0-beta24/shoelace.css">
       

    </head>
    
    <body>
        
            <br>
            <br>
            <h1 style="text-align: center;">Panier validé !</h1>
            <br>
              
            <div style="text-align: center">
                <h3 style="text-align: center;">Le montant total du panier est : <?php echo $_SESSION['total'];?>€</h3>
            </div>

            <form action="carteBancaire.php" method="post">
                <p>Numéro de carte : <input type="text" name="numCb" /></p>
                <p>cryptogramme visuel : <input type="text" name="crypto" /></p>
                <p><input type="submit" value="OK"></p>
            </form>


            
        <!--JavaScript at end of body for optimized loading-->
        <link rel="stylesheet" href="https://cdn.shoelace.style/1.0.0-beta24/shoelace.css">
    </body>
    </body>
</html>

<?php 
session_destroy(); //finalement, on détruit la session.
?>