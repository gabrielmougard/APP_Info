<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 11/06/2019
 Time: 14:56
 */
include('modeles/connexion.php');
include('modeles/requetes.logs.php');

$intPieceSelect=intval($_GET['pieceSelect']);
echo("pieceSelect=");
var_dump($intPieceSelect);
getTramesFromRepere($bdd,$intPieceSelect);
$_GET['cible']="dashboard";
$_GET['fonction']="statistiques";
include("../index.php");