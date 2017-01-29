<?php
session_start();
if (!isset ($_SESSION["login"])){
    header("location:index.php");
    exit();
}

include("header.php");
?>



    <section class="content">
        <div class="container-fluid">


            <div class="block-header">
                <h2>Commandes</h2>
            </div>
            <!-- Basic Table -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Historiques des commandes
                            </h2>

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Ref Commande</th>
                                    <th>Date Commande</th>
                                    <th>Produit(s)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once("config/MyPDO.class.php");
                                $connect = new MyPDO();
                                $idClient=$_SESSION["id"];
                                $req="SELECT * FROM `commande`,`lignecommande` WHERE `utilisateur`='$idClient' AND `commande`.`idCommande`=`lignecommande`.`idCommande` AND `etat`=1 ORDER BY `dateCommande` DESC ";
                                $oPDOStatement=$connect->query($req);
                                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                                $nbre=0;
                                while ($row = $oPDOStatement->fetch()) {
                                    $nbre++;
                                    $refCommade = $row->idCommande;
                                    $dateCommandeE = $row->dateCommande;
                                    $dateCommande = date("d-m-Y", strtotime($dateCommandeE));
                                    $idCommande=$refCommade;
                                    ?>

                                    <tr>

                                        <td><a href="detailsClientCommande.php?commande=<?php echo $refCommade; ?>" id="iframe">CMD<?php echo $refCommade; ?></a></td>
                                        <td><a href="detailsClientCommande.php?commande=<?php echo $refCommade; ?>" id="iframe"><?php echo $dateCommande; ?></a></td>
                                        <td>
                                            <?php
                                            $req2="SELECT `lignecommande`.`qte` AS qteCommande,`refProduit`,`etat` FROM `lignecommande`,`produits` WHERE `idCommande`='$idCommande' AND `etat`=1 AND `lignecommande`.`idProduit`=`produits`.`id` ";
                                            $oPDOStatement2=$connect->query($req2);
                                            $oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);

                                            while ($row2 = $oPDOStatement2->fetch()) {

                                                $refProduit = $row2->refProduit;
                                                echo '<a href="detailsClientCommande.php?commande=<?php echo $refCommade; ?>" id="iframe">';
                                                echo $refProduit."<br>";
                                                echo '</a>';


                                    }
                                            ?>

                                        </td>
                                    </tr>
                                    <?php
                                }
                                    ?>
                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>
            </div>

            <!-- #END# Basic Table -->
        </div>
    </section>

    <!--POP-PUP begin-------------------------------------------------------------------------------------------------->


<?php
include("footer.php");
