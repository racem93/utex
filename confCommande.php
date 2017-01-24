
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
        <div class="block-header">
        </div>
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body bg-blue-grey">
                        <div class="align-center">
                            <i class="material-icons font-50 ">warning</i>
                            <div class="font-30">votre commande a bien été prise en compte.<br><br>Nous reviendrons vers vous
                                dans les plus brefs délais!</div>
                            <br>
                        </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                <a href="ajoutCommande.php">
                                    <button type="button" class="btn btn-block btn-lg btn-default waves-effect ">
                                        <i class="material-icons bg-blue-grey">call_missed</i>
                                        Retour
                                    </button>
                                </a>
                            </div>


                        <br>
                        <br>
                        </div>


                        </div>
                </div>
            </div>










        </div>
    </div>
    <!-- #END# Horizontal Layout -->

</section>


<?php
include("footer.php");