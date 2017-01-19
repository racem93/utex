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
	$a++;
	$idProduit=$row->id;
}
if ($a == 0) { echo "<SCRIPT LANGUAGE='JavaScript'>
                    self.parent.location.href='ajoutCommande.php?msg=notfound';
                    </SCRIPT> ";
	die;
}
if($_POST['action'] == 'ajout') {

  if (!isset ($_SESSION['panier']) ){
	$_SESSION['panier']=array();
	}
		
			
      $id_article=$idProduit;
       $quantite_article=$qte;
        $_SESSION['panier'][$id_article]=$quantite_article;
		print("Votre produit a ete ajoute avec succes");


	}
	


?>