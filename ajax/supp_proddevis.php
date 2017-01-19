<?php 
session_start ();
$idProduit=$_GET["id"];
$_SESSION['etat'][$idProduit]=0;
header("location:../commande.php");

?>