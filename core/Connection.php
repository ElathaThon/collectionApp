<?php
class Connection{


private $dbh = NULL;

function Connection(){

    $dbHost = Constants::$HOST;
    $dbName = Constants::$DATABASE;
    $dbUser = Constants::$USER_NAME;
    $dbPassword = Constants::$PASSWORD;
    
    try {
        $this->dbh = new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    
}

function getConnection(){
    return $this->conn;
}







}
?>