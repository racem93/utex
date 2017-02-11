<?php /**
* Classe de manipulation de base MySQL
**/


class MyPDO1 extends PDO
{
private $connection = false; //Instance PDO
public function __construct()
{
$base='datades';
//Connexion au serveur
$dsn="mysql:host=41.228.165.240;port=8933;dbname=".$base; //data Source Name
$user='utex';
$pass='Utex*2017*';
try
{
//Création d’un objet de la classe PDO en utilisant le constructeur de la classe PDO
$this->connection = parent::__construct($dsn,$user,$pass); 
// Configuration du pilote : nous voulons des exceptions
$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Obligatoire pour la suite
}
catch(PDOException $e)
{
echo "Échec : " . $e->getMessage();
}
}
}
?>
