<?php 
session_start ();
$idProduit=$_GET["id"];
$_SESSION['etat'][$idProduit]=2;
$_SESSION['comptpanier']--;
header("location:../commande.php");

?>