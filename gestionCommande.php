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
                        <form action="gestionCommande.php" method="post">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-md-9 col-xs-8">
                                <p>
                                    <b>Filtrer par client</b>
                                </p>

                            <?php
                            include_once("config/MyPDO.class.php");
                            $connect = new MyPDO();
                            $req="SELECT * FROM `utilisateur` WHERE `profile`=2 ";
                            $oPDOStatement=$connect->query($req);
                            $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control show-tick" data-live-search="true" name="utilisateur" >
                                <option value="-1" >Tous</option>
                            <?php
                            while ($row = $oPDOStatement->fetch()) {
                                $login = $row->login;
                                $idUtilisateur=$row->idUtilisateur;
                                ?>
                               <option value="<?php echo $idUtilisateur;?>"
                               <?php
                               if(isset($_POST['chercher'])) {
                                   if ($idUtilisateur==$_POST['utilisateur']){
                                       echo "selected";
                                   }
                               }
                               ?>><?php echo $login; ?></option>
                                <?php
                            }
                            ?>


                                </select>
                                    </div>
                                <div class="col-md-3 col-xs-3">
                                    <br>
                                    <div class="align-center">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="chercher"  >Chercher</button>
                                </div>
                                    </div>

                            </div>
                        </div>
                            </form>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example2 dataTable">
                                <thead>
                                <tr>
                                    <th>Ref Commande</th>
                                    <th>Client</th>
                                    <th>Date Commande</th>
                                    <th>Statut</th>
                                    <th>Produit(s)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($_POST['chercher']))
                                {
                                $utilisaeur = $_POST['utilisateur'];
                                    if ($utilisaeur==-1){
                                        $req = "SELECT * FROM `commande`,`utilisateur` WHERE `commande`.`utilisateur`=`utilisateur`.`idUtilisateur` ORDER BY `dateCommande` DESC ";
                                    }
                                    else
                                $req="SELECT * FROM `commande`,`utilisateur` WHERE `commande`.`utilisateur`=`utilisateur`.`idUtilisateur` AND `utilisateur`.`idUtilisateur`='$utilisaeur' ORDER BY `dateCommande` DESC ";
                                }
                                else {
                                    $req = "SELECT * FROM `commande`,`utilisateur` WHERE `commande`.`utilisateur`=`utilisateur`.`idUtilisateur` ORDER BY `dateCommande` DESC ";
                                }
                                $oPDOStatement=$connect->query($req);
                                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                                while ($row = $oPDOStatement->fetch()) {
                                    $refCommande = $row->idCommande;
                                    $utilisaeur =$row->login;
                                    $dateCommandeE = $row->dateCommande;
                                    $traite =$row->traite;
                                    $dateCommande = date("d-m-Y", strtotime($dateCommandeE));
                                    ?>
                                    <tr>
                                        <td><a href="detailsCommande.php?commande=<?php echo $refCommande; ?>&date=<?php echo $dateCommande; ?>&traite=<?php echo $traite; ?>" id="iframe">CMD<?php echo $refCommande; ?></a></td>
                                        <td><a href="detailsCommande.php?commande=<?php echo $refCommande; ?>&date=<?php echo $dateCommande; ?>&traite=<?php echo $traite; ?>" id="iframe"><?php echo $utilisaeur; ?></a></td>
                                        <td><a href="detailsCommande.php?commande=<?php echo $refCommande; ?>&date=<?php echo $dateCommande; ?>&traite=<?php echo $traite; ?>" id="iframe"><?php echo $dateCommande; ?></a></td>
                                        <td>
                                            <?php if ($traite==0){ ?>
                                               <a href="detailsCommande.php?commande=<?php echo $refCommande; ?>&date=<?php echo $dateCommande; ?>&traite=<?php echo $traite; ?>" id="iframe">
                                                <?php
                                                echo '<span class="label bg-blue">non traité</span>';
                                                echo '</a>';
                                            } ?>
                                            <?php if ($traite==1){ ?>
                                                <a href="detailsCommande.php?commande=<?php echo $refCommande; ?>&date=<?php echo $dateCommande; ?>&traite=<?php echo $traite; ?>" id="iframe">
                                               <?php
                                                echo '<span class="label bg-green">traité</span>';
                                                echo '</a>';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php
                                            $req2="SELECT `lignecommande`.`qte` AS qteCommande,`refProduit`,`etat` FROM `lignecommande`,`produits` WHERE `idCommande`='$refCommande'  AND `lignecommande`.`idProduit`=`produits`.`id` ";
                                            $oPDOStatement2=$connect->query($req2);
                                            $oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);
                                            $nbre=0;
                                            while ($row2 = $oPDOStatement2->fetch()) {
                                                $refProduit = $row2->refProduit;?>
                                                <a href="detailsCommande.php?commande=<?php echo $refCommande; ?>&date=<?php echo $dateCommande; ?>&traite=<?php echo $traite; ?>" id="iframe">
                                                <?php
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
?>
<script type="text/javascript">
    $(function () {
        $('.js-basic-example2').DataTable({
            "bSort":   false,

        } );
        //Exportable table

    });
</script>
