
<?php

include_once("config/MyPDO.class.php");
$connect = new MyPDO();


$req2= "UPDATE site SET etat = '0' WHERE idSite = 1";
$oPDOStatement7=$connect->query($req2);

?>
