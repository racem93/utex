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
                                Gestion des commandes
                            </h2>

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example2 dataTable">
                                <thead>
                                <tr>
                                    <th>Ref Commande</th>
                                    <th>Date Commande</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once("config/MyPDO.class.php");
                                $connect = new MyPDO();
                                $req="SELECT * FROM `commande` ORDER BY `dateCommande` DESC ";
                                $oPDOStatement=$connect->query($req);
                                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                                while ($row = $oPDOStatement->fetch()) {
                                    $refCommande = $row->idCommande;
                                    $utilisaeur =$row->utilisateur;
                                    $dateCommandeE = $row->dateCommande;
                                    $traite =$row->traite;
                                    $dateCommande = date("d-m-Y", strtotime($dateCommandeE));
                                    ?>
                                        <td>CMD<?php echo $refCommande; ?></td>
                                        <td><?php echo $dateCommande; ?></td>
                                        <td>
                                            <?php if ($traite==0){ echo '<span class="label bg-blue">non traité</span>';} ?>
                                            <?php if ($traite==1){ echo '<span class="label bg-green">traité</span>';} ?>
                                        </td>
                                        <td>
                                            <a href="detailsCommande.php?commande=<?php echo $refCommande; ?>&date=<?php echo $dateCommande; ?>&traite=<?php echo $traite; ?>" id="iframe">
                                                <button type="button" class="btn btn-info waves-effect">détails</button>
                                            </a>
                                        </td>
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
