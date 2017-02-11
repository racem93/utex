
<?php

//$id=$_GET["id"];
session_start();
if (!isset ($_SESSION["login"])){
    header("location:index.php");
    exit();
}


?>

<?php
    //$utilisateur=$_SESSION["id"];
    //include_once("config/MyPDO.class.php");
    //$connect = new MyPDO();
   /* $req="SELECT * FROM `utilisateur` WHERE `idUtilisateur`='$idd' ";
    $oPDOStatement=$connect->query($req);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    $a=0;
    while ($row = $oPDOStatement->fetch())
    {
        //$a++;
		
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

    }
	
   */
	
	 $target_dir = "images/upload/";
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
 if(isset($_POST["submit"])) {
 extract($_POST);
    if ($target_file == "images/upload/") {
        $msg = "cannot be empty";
        $uploadOk = 0;
    }

// Check if file already exists
    else if (file_exists($target_file)) {
        $msg = "Sorry, file already exists.";
        $uploadOk = 0;
}

// Check file size
    else if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $msg = "Sorry, your file is too large.";
        $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
    else if ($uploadOk == 0) {
        $msg = "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
}   else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $msg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

			include_once("config/MyPDO.class.php");
 $connect = new MyPDO();
if (isset($_FILES["fileToUpload"]["name"])){
$file="";
$file=$_FILES["fileToUpload"]["name"];
$req2 = "INSERT INTO utilisateur (nomclient, prenom, login, password, email, societe, tel, mobile, adr, photo, profile) 
VALUES (" ."'".$nomclient ."'".","."'".$prenom ."'".","."'".$login ."'".","."'".$password."'".","."'".$email."'".","."'".$societe."'".","."'".$tel."'".","."'".$mobile."'".","."'".$adr."'".","."'".$file."'".",2)";

//$req2= "UPDATE utilisateur SET nomclient = '$nomclient', prenom = '$prenom', login = '$login', password = '$password', societe = '$societe', email = '$email', tel = '$tel', mobile = '$mobile', adr = '$adr', photo = '$file'  WHERE idUtilisateur = $idd";
}else{

$req2 = "INSERT INTO utilisateur (nomclient, prenom, login, password, email, societe, tel, mobile, adr, photo, profile) 
VALUES (" ."'".$nomclient ."'".","."'".$prenom ."'".","."'".$login ."'".","."'".$password."'".","."'".$email."'".","."'".$societe."'".","."'".$tel."'".","."'".$mobile."'".","."'".$adr."'".","."'".$file."'".",2)";

//$req2= "UPDATE utilisateur SET nomclient = '$nomclient', prenom = '$prenom', login = '$login', password = '$password', societe = '$societe', email = '$email', tel = '$tel', mobile = '$mobile', adr = '$adr', photo = '$photo'  WHERE idUtilisateur = $idd";
}
//$req2 = "UPDATE `utilisateur` SET `login`=$login,`password`='$password',`nomclient`='$nomclient',`prenom`='$prenom',`societe`='$societe',`photo`='$file',`tel`='$tel',`mobile`='$mobile',`email`='$email',`adr`='$adr' WHERE `idUtilisateur`='$idd'";
$oPDOStatement2 = $connect->query($req2);
/*echo "<SCRIPT LANGUAGE='JavaScript'>
self.parent.location.href='profile.php';
self.parent.$.fancybox.close();
</SCRIPT> ";
*/
			
			}

}

}

 
	
	
  
  
    


include("header.php");
?>



    <section class="content">
        <div class="container-fluid">
            <?php
            if (isset($_GET["msg"])) {
            $msg=$_GET["msg"];
            if ($msg=="notfound") { echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                La référence de produit n\'existe pas!!
            </div>';}
            elseif ($msg=="insuffisante") { echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                La quantité souhaiter n\'est pas disponible !!
            </div>';}
            elseif ($msg=="ajouter") { echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Le produit a été ajouter dans votre panier!!
            </div>';}
            elseif ($msg=="commander") { echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                La commande a été ajouter avec succés!!
            </div>';}
            }
            ?>
            <!-- Panier -->

            

            <!--END Panier -->
            <div class="block-header">
                <?php
                //var_dump($_SESSION);
                ?>

                <h2>Clients</h2>
           
            </div>
            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Ajout client
                            </h2>

                        </div>
                        <div class="body">
                            <form class="form-horizontal" id="form_advanced_validation" method="post" action="ajoutclient.php" enctype="multipart/form-data">

							<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Login</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="login"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Password</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" type="password" name="password"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
							
							
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Nom</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">

                                    </div>
									
									
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="nomclient"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								   <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Prénom</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="prenom"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								
								
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Société</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="societe"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">E-mail</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="email"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Tel</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="tel"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Mobile</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="mobile"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Address</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="skills" name="adr"  class="form-control" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
                             <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Photo</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">

                                    </div>
									
									
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
							<div class="fallback">
                                    <input name="fileToUpload" type="file"  />
                                </div>

								</div>
                                        </div>
                                    </div>
                                </div>
					   

                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="submit" >Ajouter</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->
            </div>
        </section>


<?php
include("footer.php");