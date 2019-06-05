<?php
function insertTrame($bdd,$trame){
    $query = "INSERT INTO utilisateurs (nom, prenom, email, role, passwordHash, derniereVerificationEmail, idType) ".
        "VALUES (:nom, :prenom, :email, :role,:passwordHash, :derniereVerificationEmail,1)";




}