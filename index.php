<?php
//$id=$_GET["id"];
session_start();
if (isset ($_SESSION["login"])){
    header("location:ajoutCommande.php");
    exit();
}
?>
<?php
if (isset($_POST["connexion"])) {
    extract($_POST);
    include_once("config/MyPDO.class.php");
    $connect = new MyPDO();
    $req="SELECT * FROM `utilisateur` WHERE `login`='$login' and password='$password'";
    $oPDOStatement=$connect->query($req);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    $a=0;
    while ($row = $oPDOStatement->fetch())
    {
        $a++;
        $id=$row->idUtilisateur;
    }
    if ($a == 0) { echo "<SCRIPT LANGUAGE='JavaScript'>
                    self.parent.location.href='index.php?msg=notfound';
                    </SCRIPT> ";
                    die;
                }
    else {
        $_SESSION["login"]=$login;
        $_SESSION["id"]=$id;
        header("location:ajoutCommande.php");


    }
}
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

    <!-- Waves Effect Css -->
    <link href="plugins/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page" style="background-color: #F44336">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);"><img src="images/footer-logo.png" width="30%" height="30%"></a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" action="index.php">
                <div class="msg">Connectez-vous pour démarrer votre session
                <?php
                if (isset($_GET["msg"])) {
                    echo "<br>";
                    $msg = $_GET["msg"];
                    if ($msg == "notfound") {
                        echo '<div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                               Nom d\'utilisateur ou mot de passe est erroné!!
            </div>';
                    }
                }
                 ?>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="login" placeholder="Utilisateur" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">

                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-danger bg-pink waves-effect" type="submit" name="connexion">Connexion</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6 align-right">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="plugins/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="plugins/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="plugins/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/sign-in.js"></script>
</body>

</html>