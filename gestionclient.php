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
                <h2>Clients</h2>
            </div>
            <!-- Basic Table -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Gestion des clients
                            </h2>

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example2 dataTable">
                                <thead>
                                <tr>
                                    <th>Nom Client</th>
                                    <th>Prénom Client</th>
                                    <th>Société</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once("config/MyPDO.class.php");
                                $connect = new MyPDO();
                                $req="SELECT * FROM `utilisateur` WHERE profile=2";
                                $oPDOStatement=$connect->query($req);
                                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                                while ($row = $oPDOStatement->fetch()) {
                                    $iduser=$row->idUtilisateur;
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
                                   // $dateCommande = date("d-m-Y", strtotime($dateCommandeE));
                                    ?>
                                    <tr>
                                        <td><?php echo $nomclient; ?></td>
                                        <td><?php echo $prenom; ?></td>
                                        <td>
                                          <?php echo $societe; ?>
                                        </td>
                                        <td>
                                            <a href="detailsclient.php?id=<?php echo $iduser; ?>" id="iframe">
                                                <button type="button" class="btn btn-info waves-effect">Détails</button>
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
?>
<script type="text/javascript">
    $(function () {
        $('.js-basic-example2').DataTable({
            "bSort":   false,

        } );
        //Exportable table

    });
</script>
