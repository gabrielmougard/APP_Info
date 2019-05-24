<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion stock</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/GestionStock.css">


    <! -- lien pour les icones -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">

</head>

<?php include "vues/templates/header.php" ?>

<body>
    <div>
        <h1>Ajout dans le catalogue</h1>
        <!--<label for="">Selectonne le type de composant:</label>
        <select>
            <option value=""></option>
            <?php
            /*for($i=0;$i<count($typeComposantsExistant);$i++){
                echo '<option value="'.$typeComposantsExistant[$i]['nom'].'">'.$typeComposantsExistant[$i]['nom'].'</option>';
            }*/
            ?>
        </select>-->
        <form action="index.php?cible=dashboard&fonction=gestionStock" method="post" >
            Nom attribué:<br>
            <input type="text" name="nom"><br>
            Datasheet:<br>
            <input type="text" name="datasheet"><br>
            Prix:<br>
            <input type="number" name="prix" min="0"><br>
            reference:<br>
            <input type="text" name="reference"><br>
            <input type="submit" value="Valider" onclick="javascript:return confirm('Confirmez vous l\'ajout d\'un composant dans le catalogue ?')">
        </form>
    </div>

    <div>
        <h1>Ajoute un Type de composant</h1>
        Selectonne le composant dans le catalogue<br>
        <select name="nomType" form="typeCapteur">
            <option value=""></option>
            <?php
            for($i=0;$i<count($nomCatalogue);$i++){
                echo '<option value="'.$nomCatalogue[$i]['nom'].'">'.$nomCatalogue[$i]['nom'].'</option>';
            }
            ?>
        </select>
        <form action="index.php?cible=dashboard&fonction=gestionStock" method="post" id="typeCapteur">
            Valeur/Code affecté:<br>
            <input type="text" name="valeur"><br>
            Grandeur physique:<br>
            <input type="text" name="grandeurPhysique"><br>
            <input type="hidden" name="idAppartement" value="<?php echo($appartement[$i]['idAppartement']);?>">
            <input type="submit" value="Valider" onclick="javascript:return confirm('Confirmez vous l\'ajout d\'un type de composant ?')">
        </form>
    </div>

    <div>
        <h1>Ajoute un composant</h1>

        Selectonne le composant dans le catalogue<br>
        <select name="idCatalogue" form="Composant">
            <option value=""></option>
            <?php
            for($i=0;$i<count($nomCatalogue);$i++){
                echo '<option value="'.$nomCatalogue[$i]['nom'].'">'.$nomCatalogue[$i]['nom'].'</option>';
            }
            ?>
        </select><br>
        Selectonne le type de composant:<br>
        <select name="idTypeCapteur" form="Composant">
            <option value=""></option>
            <?php
            for($i=0;$i<count($typeComposantsExistant);$i++){
                echo '<option value="'.$typeComposantsExistant[$i]['nom'].'">'.$typeComposantsExistant[$i]['nom'].'</option>';
            }
            ?>
        </select>
        <form action="index.php?cible=dashboard&fonction=gestionStock" method="post" id="Composant">
            Numéro de série du composant:<br>
            <input type="text" name="numComposant"><br>
            <input type="submit" value="Valider" onclick="javascript:return confirm('Confirmez vous l\'ajout d\'un type de composant ?')">
        </form>


    </div>

</body>

<?php include "vues/templates/Footer.php" ?>

</html>