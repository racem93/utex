<?php
session_start ();
$refProduit=$_GET["ref"];
$qte=$_GET["qte"];
include_once("../config/MyPDO.class.php");
$connect = new MyPDO();
$req="SELECT `id` FROM `produits` WHERE `refProduit`='$refProduit' ";
$oPDOStatement=$connect->query($req);
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
$a=0;
while ($row = $oPDOStatement->fetch())
{
    $idProduit=$row->id;
}
$_SESSION['qte'][$idProduit]=$qte;
$_SESSION['etat'][$idProduit]=1;
$_SESSION['comptpanier']=count($_SESSION['qte']);
echo "<SCRIPT LANGUAGE='JavaScript'>
self.parent.location.href='../Commande.php';
self.parent.$.fancybox.close();
</SCRIPT> ";
