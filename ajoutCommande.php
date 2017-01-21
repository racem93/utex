
<?php
function panier($idProduit,$qte,$etat ){
    if (!isset ($_SESSION['qte']) ){
        $_SESSION['qte']=array();
        $_SESSION['etat']=array();
    }

    $id_article=$idProduit;
    $quantite_article=$qte;
    $_SESSION['qte'][$id_article]=$quantite_article;
    $_SESSION['etat'][$id_article]=$etat;
    if ($etat==0){
                echo "<SCRIPT LANGUAGE='JavaScript'>
                self.parent.location.href='ajoutCommande.php?msg=insuffisante';
                </SCRIPT> ";
                die;}
    if ($etat==1){
        echo "<SCRIPT LANGUAGE='JavaScript'>
                self.parent.location.href='ajoutCommande.php?msg=ajouter';
                </SCRIPT> ";
        die;}



}
//$id=$_GET["id"];
session_start();
if (!isset ($_SESSION["login"])){
    header("location:index.php");
    exit();
}
?>
<?php
if (isset($_POST["commande"])) {
    $utilisateur=$_SESSION["id"];
    extract($_POST);
    include_once("config/MyPDO.class.php");
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
    $req="SELECT `qte` FROM `produits` WHERE `id`='$idProduit' ";
    $oPDOStatement=$connect->query($req);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $oPDOStatement->fetch())
    {
        $qteProduit=$row->qte;
    }
    $req="SELECT `qte` FROM `lignecommande` WHERE `idProduit`='$idProduit' AND `etat`=1 ";
    $oPDOStatement=$connect->query($req);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    $commandeTotale=0;
	$comptpanier=0;

    while ($row = $oPDOStatement->fetch())
    {
        $commandeTotale= $commandeTotale+($row->qte);
		    	

	}
    $qteDisponible=$qteProduit-$commandeTotale;
    if($qteCommande>$qteDisponible) {
                                    panier($idProduit,$qteCommande,0);

                                     }
    else {
        panier($idProduit,$qteCommande,1);
    }
}



include("header.php");
?>


    <section class="content">
        <div class="container-fluid">
            <?php
            if (isset($_GET["msg"])) {
            $msg=$_GET["msg"];
            if ($msg=="notfound") { echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                La référence de produit n\'existe pas!!
            </div>';}
            elseif ($msg=="insuffisante") { echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                La quantité souhaiter n\'est pas disponible !!
            </div>';}
            elseif ($msg=="ajouter") { echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Le produit a été ajouter dans votre panier!!
            </div>';}
            elseif ($msg=="commander") { echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                La commande a été ajouter avec succés!!
            </div>';}
            }
            ?>
            <!-- Panier -->

            

            <!--END Panier -->
            <div class="block-header">
                <?php
                var_dump($_SESSION);
                ?>

                <h2>Commande</h2>
                <div class="navbar-right">

			  
			  	<a href="Commande.php" class="buybtn">
						<span class="buybtn-text">Produits Sélectionnés(<?php 
						if (isset($_SESSION['comptpanier'])){
						echo $_SESSION['comptpanier']; 
						}else{
						echo "0";
						}
						
						?>)
						</span> 
						<span class="buybtn-hidden-text">Voir commande</span>
						<span class="buybtn-image"><span></span></span>
					</a>		
                    </div>
            </div>
            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Nouveau commande
                            </h2>

                        </div>
                        <div class="body">
                            <form class="form-horizontal" id="form_advanced_validation" method="post" action="ajoutCommande.php" >

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Produit</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">

                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="refProduit"  class="form-control" placeholder="REF Produit" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Quantité</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-8 col-xs-7">
                                        <div class="form-group form-float" >
                                            <div class="form-line" >
                                                <input type="number" name="qteCommande" id="quant" class="form-control" placeholder="Qte" min="1" max="50" required>
                                            </div>
                                            <div class="help-info">Min:1, Max:50 (mètre)</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="commande"  >Ajouter</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->
            </div>
        </section>


<?php
include("footer.php");