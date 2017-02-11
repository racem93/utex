<?php
session_start();
if (!isset ($_SESSION["login"])){
    header("location:index.php");
    exit();
}
$idd=$_GET["id"];

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


  <?php
                                include_once("config/MyPDO.class.php");
                                $connect = new MyPDO();
								$req= "Select * FROM utilisateur WHERE idUtilisateur='$idd'";

                                $oPDOStatement=$connect->query($req);
                                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                                while ($row = $oPDOStatement->fetch()) {
                                   $login=$row->login;
									$password=$row->password;
									$adr=$row->adr;
									$nomclient=$row->nomclient;
									$prenom=$row->prenom;
									$societe=$row->societe;
									$photo=$row->photo;
									$tel=$row->tel;
									$mobile=$row->mobile;
									$email=$row->email;

                                    ?>

            <!-- Basic Table -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <font color="blue" ><b>Client:</b></font> <?php echo $prenom." ".$nomclient."<br>"."(".$societe.")" ;?>
                            </h2>

                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Login</th>
                                    <th>Tel/Mobile</th>
                                    <th>E-mail</th>
                                    <th>Adr</th>
                                </tr>
                                <tbody>
                                </thead>
                              

                                    <tr>
                                        <td><?php echo $login; ?></td>
                                        <td><?php echo $tel."/".$mobile; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $adr; ?></td>

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
