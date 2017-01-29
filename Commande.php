<?php
function panier($idProduit,$qte,$etat ){
    if (!isset ($_SESSION['qte']) ){
        $_SESSION['qte']=array();
        $_SESSION['etat']=array();
        $_SESSION['comptpanier']=0;
    }

    $id_article=$idProduit;
    $quantite_article=$qte;
    $_SESSION['qte'][$id_article]=$quantite_article;
    $_SESSION['etat'][$id_article]=$etat;
    $_SESSION['comptpanier']=count($_SESSION['qte']);




}

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
            <h2>Commande</h2>
            <div class="navbar-right">


                <a href="Commande.php" class="buybtn">
						<span class="buybtn-text">Produits Sélectionnés(<?php
                            if (isset($_SESSION['comptpanier'])){
                                echo $_SESSION['comptpanier'];
                            }else{
                                echo "0";
                            }

                            ?>)
						</span>
                    <span class="buybtn-hidden-text">Voir commande</span>
                    <span class="buybtn-image"><span></span></span>
                </a>
            </div>
        </div>
        <!-- Basic Table -->

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        RÉCAPITULATIF DE LA COMMANDE
                    </h2>

                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Qte</th>
                            <th>Staut</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if(!empty($_SESSION['qte'])) {

                        include_once("config/MyPDO.class.php");
                        $connect = new MyPDO();

                         //Début vérification qte
                        if (isset($_POST["editQnt"])) {
                            $utilisateur = $_SESSION["id"];
                            extract($_POST);
                            $req="SELECT `qte` FROM `produits` WHERE `id`='$idProduit' ";
                            $oPDOStatement=$connect->query($req);
                            $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                            while ($row = $oPDOStatement->fetch())
                            {
                                $qteProduit=$row->qte;
                            }
                            $req="SELECT `qte` FROM `lignecommande` WHERE `idProduit`='$idProduit' AND `etat`=1 ";
                            $oPDOStatement=$connect->query($req);
                            $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                            $commandeTotale=0;
                            $comptpanier=0;

                            while ($row = $oPDOStatement->fetch())
                            {
                                $commandeTotale= $commandeTotale+($row->qte);


                            }
                            $qteDisponible=$qteProduit-$commandeTotale;
                            if($qteCommande>$qteDisponible) {
                                $req = "INSERT INTO histcommande ( utilisateur,idProduit,qte,etat)
                                            VALUES ("."'".$utilisateur."'".","."'".$idProduit."'".","."'".$qteCommande."'".",0)";
                                $oPDOStatement5=$connect->query($req); // Le résultat est un objet de la classe PDOStatement
                                panier($idProduit,$qteCommande,0);

                            }
                            else {
                                $req = "INSERT INTO histcommande ( utilisateur,idProduit,qte,etat)
                VALUES ("."'".$utilisateur."'".","."'".$idProduit."'".","."'".$qteCommande."'".",1)";
                                $oPDOStatement5=$connect->query($req); // Le résultat est un objet de la classe PDOStatement
                                panier($idProduit,$qteCommande,1);
                            }
                        }
                         //Fin vérification qte

                        //function cherche les produits similaires
                        function equivalence($ref,$qteCommande){
                            $lien=array();
                            include_once("config/MyPDO.class.php");
                            $connect = new MyPDO();
                            $req4 = "SELECT `produits`.`id` AS idProduit,refprod2,qte FROM equivalance ,produits  WHERE `refprod1`='$ref' AND `refprod2`=`refProduit` AND `qte`>='$qteCommande'    ";
                            $oPDOStatement4=$connect->query($req4); // Le résultat est un objet de la classe PDOStatement
                            $oPDOStatement4->setFetchMode(PDO::FETCH_OBJ);
                            while ($row4=$oPDOStatement4->fetch())
                            {
                                $idProduit=$row4->idProduit;
                                $refprod2=$row4->refprod2;
                                $qteProduit=$row4->qte;
                                //récuppére les qnts qui sont commandé et ne sont pas encoré traiter
                                $req="SELECT `qte` FROM `lignecommande`,`commande` WHERE `idProduit`='$idProduit' AND `lignecommande`.`idCommande`=`commande`.`idCommande` AND `etat`=1 AND `traite`=0 ";
                                $oPDOStatement=$connect->query($req);
                                $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                                $commandeTotale=0;
                                while ($row = $oPDOStatement->fetch())
                                {
                                    $commandeTotale= $commandeTotale+($row->qte);
                                }
                                $qteDisponible=$qteProduit-$commandeTotale;
                                if($qteCommande<=$qteDisponible) {
                                                                array_push($lien,$refprod2);
                                }

                            }
                            return $lien;

                        }
                        //Fin function

                        // on extrait les id du caddie
                        $id_liste = implode(',', array_keys($_SESSION['qte']));


                        // on fait notre requête
                        $req = "select * from produits where id IN(" . $id_liste . ")";
                        $oPDOStatements = $connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
                        $oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                        //insertion de commande
                            if (isset($_POST["submit"])) {
                                $utilisateur=$_SESSION["id"];
                                $datecommande = date("Y-m-d");
                                $req1 = 'INSERT INTO `commande`( `utilisateur`,`dateCommande`)
                                    VALUES (' . '"' . $utilisateur . '"' . ',' . '"' . $datecommande . '"' . ')';
                                $oPDOStatement = $connect->query($req1); // Le résultat est un objet de la classe PDOStatement
                                $req2 = "SELECT * FROM commande WHERE idCommande=(SELECT MAX(idCommande) as 'DERNIER_ID' from commande)";
                                $oPDOStatement3=$connect->query($req2); // Le résultat est un objet de la classe PDOStatement
                                $oPDOStatement3->setFetchMode(PDO::FETCH_OBJ);
                                while ($row1=$oPDOStatement3->fetch())
                                {
                                    $iddernier=$row1->idCommande;

                                }


                            }
                                //Fin insertion de commande


                        while ($data = $oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                        {
                        $idProduit = $data['id'];
                        $refProduit = $data['refProduit'];
                        $qte = $_SESSION['qte'][$idProduit];
                        $etat=$_SESSION['etat'][$idProduit];


                        if ($etat != 2) {
                        ?>
                        <tr>
                            <td ><?php echo $refProduit; ?></td>
                            <td class="col-sm-3" >
                                <form class="form-horizontal" id="form_advanced_validation" method="post" action="Commande.php" >
                                <div class="row">
                                    <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-inline">
                                        <input type="number" name="qteCommande" id="quant" class="form-control" placeholder="Qte" value="<?php echo $qte; ?>" min="1" max="50" required>
                                    </div>
                                    <div class="help-info">Min:1, Max:50</div>
                                    </div>
                                        <input type="hidden" value="<?php echo $idProduit; ?>" name="idProduit">
                                        </div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn bg-orange waves-effect" name="editQnt">
                                            <i class="material-icons">mode_edit</i>
                                        </button>
                                    </div>
                                </div>
                                    </form>
                            </td>
                            <td>
                                <?php
                                //test quand la quantité n'est pas disponible
                                $arrivage=0;
                                $lien=array();
                                if ($etat == 1)  echo "Disponible";
                                if ($etat == 0) {
                                    $arrivage=$data['arrivage'];
                                    if ($arrivage>=$qte){
                                        echo "Bientôt disponible";
                                    }
                                    else {
                                        $lien=equivalence($refProduit,$qte);
                                        echo "Pas disponible<br>";
                                        echo "Suggestion:<br>";
                                        foreach($lien as $suggestion){
                                            echo "<a href='ajax/ajoutSuggestion.php?ref=".$suggestion."&qte=".$qte."' >".$suggestion."</a>";
                                            echo "<br>";
                                        }
                                    }

                                }
                                //fin test qnt non disponible
                                ?>
                            </td>
                            <td>
                                <ol class="breadcrumb breadcrumb-col-red">
                                    <li>
                                    <a href="ajax/supp_proddevis.php?id=<?php echo $idProduit; ?>" >
                                        <i class="material-icons ">delete</i>
                                    </a>
                                    </li>
                                    </ol>
                            </td>
                        </tr>
                        </tbody>
                        <?php
                        //insertion ligne de commande
                        }
                        if(isset($_POST['submit']))
                        {
                            $req = "INSERT INTO ligneCommande ( idCommande,idProduit,qte,etat)
                            VALUES ("."'".$iddernier."'".","."'".$idProduit."'".","."'".$qte."'".","."'".$etat."'".")";
                            $oPDOStatement5=$connect->query($req); // Le résultat est un objet de la classe PDOStatement

                        }
                        //Fin insertion ligne de commande


                        }
                        ?>
                    </table>

                </div>
                <form method="post" action="Commande.php">
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <h5> <a href="ajoutCommande.php"><<< Continuer mes achats</a></h5>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-primary m-t--15 waves-effect" type="submit" name="submit">Commander</button>
                        </div>
                    </div>
                </form>
                <br>

            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['submit'])) {
        unset($_SESSION['qte']);
        unset($_SESSION['etat']);
		unset($_SESSION['comptpanier']);
       echo "<SCRIPT LANGUAGE='JavaScript'>
                self.parent.location.href='confCommande.php';
             </SCRIPT> ";
    }
}
    ?>
        <!-- #END# Basic Table -->
    </div>
</section>


<?php
include("footer.php");
