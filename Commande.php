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
            <h2>Commande</h2>
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

				$comptpanier=0;
                        while ($data = $oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                        {
						$comptpanier=$comptpanier+1;
					   $_SESSION['comptpanier']=$comptpanier;
                        $idProduit = $data['id'];
                        $refProduit = $data['refProduit'];
                        $qte = $_SESSION['qte'][$idProduit];
                        $etat=$_SESSION['etat'][$idProduit];


                        if ($etat != 2) {
                        ?>
                        <tr>
                            <td><?php echo $refProduit; ?></td>
                            <td><?php echo $qte; ?></td>
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
                self.parent.location.href='ajoutCommande.php?msg=commander';
                </SCRIPT> ";
    }
}
    ?>
        <!-- #END# Basic Table -->
    </div>
</section>


<?php
include("footer.php");
