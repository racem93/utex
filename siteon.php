
<?php
set_time_limit(0);

include_once("config/MyPDO.class.php");
$connect = new MyPDO();
include_once("config/MyPDO1.class.php");
$connect1 = new MyPDO1();

$req="TRUNCATE TABLE `produits`";
$oPDOStatement5=$connect->query($req);
// on fait notre requête
$req = "SELECT * FROM stock_des";
$oPDOStatements = $connect1->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
$oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
//insertion de commande
while ($b159 = $oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
{


    @$arrivage=$b159[arrivage];
    @$stock=$b159[stock];
    @$refProduit=$b159[NOM_PRODUIT];
    @$id=$b159[id];
    @$imageProduit=$b159[id].".jpg";
    // Insertion des données dans la base local
    $req = "INSERT INTO produits ( id,refProduit,qte,arrivage,imageProduit)
                            VALUES ("."'".$id."'".","."'".$refProduit."'".","."'".$stock."'".","."'".$arrivage."'".","."'".$imageProduit."'".")";
    $oPDOStatement5=$connect->query($req); // Le résultat est un objet de la classe PDOStatement
}

$req2= "UPDATE site SET etat = '1' WHERE idSite = 1";
$oPDOStatement7=$connect->query($req2);

echo "<font color='red'>La base des données est mise à jour!</font>";
?>
