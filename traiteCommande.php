<?php
session_start();
if (!isset ($_SESSION["login"])){
    header("location:index.php");
    exit();
}
$idCommande=$_GET["commande"];
include_once("config/MyPDO.class.php");
$connect = new MyPDO();
$req2 = "UPDATE `commande` SET `traite`=1 WHERE `idCommande`=$idCommande ";
$oPDOStatement = $connect->query($req2);
echo "<SCRIPT LANGUAGE='JavaScript'>
self.parent.location.href='gestionCommande.php';
self.parent.$.fancybox.close();
</SCRIPT> ";