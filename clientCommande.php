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
                                    <th>#</th>
                                    <th>Ref Commande</th>
                                    <th>Date Commande</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once("config/MyPDO.class.php");
                                $connect = new MyPDO();
                                $idClient=$_SESSION["id"];
                                $req="SELECT * FROM `commande` WHERE `utilisateur`='$idClient' ORDER BY `dateCommande` DESC ";
                                $oPDOStatement=$connect->query($req);
                                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                                $nbre=0;
                                while ($row = $oPDOStatement->fetch()) {
                                    $nbre++;
                                    $refCommade = $row->idCommande;
                                    $dateCommandeE = $row->dateCommande;
                                    $dateCommande = date("d-m-Y", strtotime($dateCommandeE));

                                    ?>

                                    <tr>
                                        <td><?php echo $nbre; ?></td>
                                        <td>CMD<?php echo $refCommade; ?></td>
                                        <td><?php echo $dateCommande; ?></td>
                                        <td>
                                            <a href="detailsClientCommande.php?commande=<?php echo $refCommade; ?>" id="iframe">
                                            <button type="button" class="btn btn-info waves-effect">détails</button>
                                            </a>
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
