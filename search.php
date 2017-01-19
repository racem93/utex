<?php
include_once("config/MyPDO.class.php");
    $connect = new MyPDO();
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
if (strlen($searchTerm)>=3) {
    $req = "SELECT * FROM produits WHERE refProduit LIKE '%" . $searchTerm . "%' ORDER BY refProduit ASC";
    $oPDOStatement = $connect->query($req);
    $oPDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $oPDOStatement->fetch()) {
        $data[] = $row['refProduit'];
    }
}
//return json data
echo json_encode($data);
?>