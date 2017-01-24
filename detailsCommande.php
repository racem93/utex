<?php
session_start();
if (!(isset ($_SESSION["login"]) && $_SESSION["profile"]==1)){
    header("location:index.php");
    exit();
}
$idCommande=$_GET["commande"];
$dateCommande=$_GET["date"];
$traite=$_GET["traite"];

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>UteX</title>
        <!-- Favicon-->
        <link rel="icon" href="../../favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap.css" rel="stylesheet">
        <!-- Autosuggestion Css -->
        <link rel="stylesheet" href="plugins/suggestion/jquery-ui.css">
        <!-- Waves Effect Css -->
        <link href="plugins/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="plugins/animate.css" rel="stylesheet" />

        <!-- Bootstrap Material Datetime Picker Css -->
        <link href="plugins/bootstrap-material-datetimepicker.css" rel="stylesheet" />

        <!-- JQuery DataTable Css -->
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Wait Me Css -->
        <link href="plugins/waitMe.css" rel="stylesheet" />

        <!-- Bootstrap Select Css -->
        <link href="plugins/bootstrap-select.css" rel="stylesheet" />

        <!-- Sweet Alert Css -->
        <link href="plugins/sweetalert.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/stylepanier.css">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->




    </head>

<body >




<!-- Basic Table -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <h2>
                   CMD<?php echo $idCommande; ?>
                            </h2>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <h2>
                        <?php echo $dateCommande; ?>
                            </h2>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <?php if ($traite==0){  ?>
                            <a href="traiteCommande.php?commande=<?php echo $idCommande; ?>">
                    <button type="button" class="btn bg-cyan btn-block btn-lg waves-effect">
                        <i class="material-icons">verified_user</i>
                        Traite
                    </button>
                                </a>
                        <?php }?>
                        <?php if ($traite==1){ echo '<h2><span class="label bg-green">traité</span></h2>';} ?>
                        </div>
                </div>

            </div>
            <div class="body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ref</th>
                        <th>Qte</th>
                        <th>Staut</th>
                    </tr>
                    <tbody>
                    </thead>
                    <?php
                    include_once("config/MyPDO.class.php");
                    $connect = new MyPDO();
                    $req="SELECT `lignecommande`.`qte` AS qteCommande,`refProduit`,`etat` FROM `lignecommande`,`produits` WHERE `idCommande`='$idCommande'  AND `lignecommande`.`idProduit`=`produits`.`id` ";
                    $oPDOStatement=$connect->query($req);
                    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                    $nbre=0;
                    while ($row = $oPDOStatement->fetch()) {
                        $nbre++;
                        $refProduit = $row->refProduit;
                        $qte = $row->qteCommande;
                        $etat = $row->etat;

                        ?>

                        <tr>
                            <td><?php echo $nbre; ?></td>
                            <td><?php echo $refProduit; ?></td>
                            <td><?php echo $qte; ?></td>
                            <td>
                                <?php if ($etat==0){ echo '<span class="label bg-orange">Non disponible</span>';} ?>
                                <?php if ($etat==1){ echo '<span class="label bg-green">Disponible</span>';} ?>
                                <?php if ($etat==2){ echo '<span class="label bg-red">Supprimé</span>';} ?>
                            </td>

                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>

                </table>

            </div>

            <br>

        </div>
    </div>
</div>

<!-- #END# Basic Table -->



<?php
include("footer.php");
