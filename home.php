
<?php

//$id=$_GET["id"];
session_start();
if (!isset ($_SESSION["login"])){
    header("location:index.php");
    exit();
}


?>
<?php




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
                //var_dump($_SESSION);
                ?>

                <h2>Tableau de boards</h2>
           
            </div>
            <!-- Horizontal Layout -->
            <div class="row clearfix">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
						
                            <h2>
                               Etat Application
                            </h2>
   <form class="form-horizontal" id="form_advanced_validation" method="post" action=".php" >

                                                           <div class="pull-right">

							    <div class="switch panel-switch-btn">
                                    <span class="m-r-10 font-12"></span>
                                    <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                </div>
							   
                                <br>

                                                               </div>

                                </div>


                              

                            </form>
                        </div>
                        <div class="body">
                         
                        </div>
                    </div>
                <?php
                include_once("config/MyPDO.class.php");
                $connect = new MyPDO();
                $req="SELECT `idCommande` AS commandes FROM `commande` WHERE `traite`=0 ";
                $oPDOStatement=$connect->query($req);
                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                $commandes=0;
                while ($row = $oPDOStatement->fetch()) {
                      $commandes++;

                                }
                $req="SELECT `id` FROM `produits` ";
                $oPDOStatement=$connect->query($req);
                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                $produits=0;
                while ($row = $oPDOStatement->fetch()) {
                    $produits++;

                }

                $req="SELECT `idUtilisateur` FROM `utilisateur` WHERE `profile`=2  ";
                $oPDOStatement=$connect->query($req);
                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                $clients=0;
                while ($row = $oPDOStatement->fetch()) {
                    $clients++;

                }
                ?>
					
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-red">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">Nouveaux Commandes</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo $commandes; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-indigo">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">Clients</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $clients; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-light-green">
                            <i class="material-icons">work</i>
                        </div>
                        <div class="content">
                            <div class="text">Produits</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $produits; ?></div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->
            </div>
        </section>


<?php
include("footer.php");