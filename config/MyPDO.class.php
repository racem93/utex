<?php /**
* Classe de manipulation de base MySQL
**/


class MyPDO extends PDO
{
private $connection = false; //Instance PDO
public function __construct()
{
$base='utex';
//Connexion au serveur
$dsn="mysql:host=localhost;dbname=".$base; //data Source Name
$user='root';
$pass='';
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
