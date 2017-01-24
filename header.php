
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>UteX</title>
    <!-- Favicon-->
    <link rel="icon" href="" type="image/x-icon">

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
    <link href="css/panier.css" rel="stylesheet">
      <link rel="stylesheet" href="css/stylepanier.css">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/theme-red.css" rel="stylesheet" />

    <script language="javascript">

        function myAjax() {
            $.ajax({
                type: "POST",
                url: 'ajax/ajax.php?ref='+document.getElementById('skills').value+'&qte='+document.getElementById('quant').value,
                data:{action:'ajout'},
                success:function(html) {
                    alert(html);
                }

            });
        }
    </script>

    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
    <style type="text/css">
        .fancybox-custom .fancybox-skin {
            box-shadow: 0 0 50px #222;
        }


    </style>


</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->

<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="#"><img src="images/footer-logo.png" style="height: 200%; width: 50%;"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->

                <!-- #END# Call Search -->
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="deconnexion.php" >Déconnexion

                    </a>
                </li>
                </ul>
            </div>

    </div>

</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login']; ?></div>
                <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="profile.php"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                        
                            <li><a href="deconnexion.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                 <?php 
				if (isset($_SESSION["profile"]) && $_SESSION["profile"]==1){
				?>
			   <li>
                    <a href="#">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
				 <?php 
				}
				?>
				
				 <?php 
				if (isset($_SESSION["profile"]) && $_SESSION["profile"]==2){
				?>
                <li>
                    <a href="ajoutCommande.php">
                        <i class="material-icons">note_add</i>
                        <span>Ajout commande</span>
                    </a>
                </li>
                <li>
                    <a href="clientCommande.php">
                        <i class="material-icons">note_add</i>
                        <span>Historiques des commandes</span>
                    </a>
                </li>
				 <?php 
					}
				?>
                <?php 
				if (isset($_SESSION["profile"]) && $_SESSION["profile"]==1){
				?>
				<li>
                    <a href="gestionCommande.php">
                        <i class="material-icons">note_add</i>
                        <span>Gestion commande</span>
                    </a>
                </li>
				 <?php 
				  }
				?>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 <a href="javascript:void(0);">UTEX</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->

    <!-- #END# Right Sidebar -->
</section>