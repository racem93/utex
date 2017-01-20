<?php 
session_start ();
$idProduit=$_GET["id"];
$_SESSION['etat'][$idProduit]=2;
header("location:../commande.php");

?>