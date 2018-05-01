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


    function redirectTo($url,$seconds){
        echo '<META http-equiv="refresh" content="'.$seconds.';URL='.$url.'">';
    }


    function createNewItem($uuid, $name, $description){
        $sql = "INSERT INTO ".Constants::$ITEM_TABLE." (".Constants::$ITEM_UUID.", ".Constants::$ITEM_NAME.", ".Constants::$ITEM_DESCRIPTION.") VALUES (?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid,$name,$description))){
            return "ok";
        } else {
            return "ko";
        }
    }


    function getAllItems(){
        $sql = "SELECT * FROM ".Constants::$ITEM_TABLE;
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array());
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
        }
        $jSON = $rawdata;
        return $jSON;
    }


    function createNewImage($uuid, $uuidItem, $url){
        $sql = "INSERT INTO ".Constants::$IMAGE_TABLE." (".Constants::$IMAGE_UUID.", ".Constants::$IMAGE_UUID_ITEM.", ".Constants::$IMAGE_URL.") VALUES (?,?,?)";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid,$uuidItem,$url))){
            return "ok";
        } else {
            return "ko";
        }
    }


}

?>