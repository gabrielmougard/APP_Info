<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/listeUtilisateurs.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Liste des utilisateurs</title>
</head>

<?php include "vues/templates/header.php" ?>

<body>

<table summary="liste Utilisateur">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Type</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Type</th>
    </tr>
    </tfoot>

    <tbody>
    <?php
    for($i=0;$i<count($utilisateurs);$i++){
        echo('<tr>
        <td>'.$utilisateurs[$i]['nom'].'</td>
        <td>'.$utilisateurs[$i]['prenom'].'</td>
        <td>'.$utilisateurs[$i]['email'].'</td>
        <td>'.$utilisateurs[$i]['type'].'</td>
    </tr>');
    }
    ?>
    </tbody>

</table>
</body>

<?php include "vues/templates/Footer.php" ?>
</html>