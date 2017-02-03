<?php
session_start();
if (!isset ($_SESSION["login"])){
    header("location:index.php");
    exit();
}


?>
<?php
$refProduit=$_GET["ref"];
$qte=$_GET["qte"];
include_once("/config/MyPDO.class.php");
$connect = new MyPDO();
$req="SELECT * FROM `produits` WHERE `refProduit`='$refProduit' ";
$oPDOStatement=$connect->query($req);
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
$a=0;
while ($row = $oPDOStatement->fetch())
{
    $idProduit=$row->id;
    $imageProduit=$row->imageProduit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>UteX</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

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
<!-- Page Loader -->


        <!-- Default Example -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <h2>Ref: <?php echo $refProduit; ?></h2>
                    <div class="body align-center">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12  ">
                                    <img src="images/produits/<?php echo $imageProduit; ?>" class="img-responsive center-block">
                            </div>
                        </div>
                        <br>
                                <a href='ajax/ajoutSuggestion.php?ref=<?php echo $refProduit; ?>&qte=<?php echo $qte; ?>'">
                                <button class="btn btn-primary m-t--15 waves-effect center-block " type="button" name="submit">Ajouter</button>
                                </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Default Example -->
        <!-- Custom Content -->
        <!-- #END# Custom Content -->


<?php
include("footer.php");