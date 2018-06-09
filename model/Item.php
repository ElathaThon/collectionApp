<?php

class Item {

    private static $ITEM_TABLE = "COLAPP_item";
    private static $ITEM_ID = "id";
    private static $ITEM_UUID = "uuid";
    private static $ITEM_NAME = "name";
    private static $ITEM_DESCRIPTION = "description";
    private static $ITEM_STAR_IMAGE = "star_image";
    private static $ITEM_USER_ID = "userID";
    private static $ITEM_PUBLIC = "public";

    //Objectes de la classe
    private $image = NULL; 
    private $dbh = NULL;

    /* TODO: Mes endevant Connection com singletion i li passem el conection per parametre al construir
   // constructor with $db as database connection 
    public function __construct($db){
        $this->conn = $db;
    }
    */


    public function __construct(){

        $dbHost = DbConnection::$HOST;
        $dbName = DbConnection::$DATABASE;
        $dbUser = DbConnection::$DB_USER_NAME;
        $dbPassword = DbConnection::$DB_PASSWORD;

        $this->image = new Image();
        /*
        $resultString = $this->image->test();
        echo $resultString . "\n--\n";
        */
        try {
            $this->dbh = new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }

    }

    function getAllItems(){
        $sql = "SELECT * FROM ".$this::$ITEM_TABLE;
        $sth = $this->dbh->prepare($sql);

        $sth->execute(array());
        $rawdata = array();
        $i = 0;
        
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
            $uuidImage = $row['star_image'];
        
            $image = $this->image->getUrlImage($uuidImage);
            $rawdata[$i]['url'] = $image;

            //print_r($rawdata);
            $i++;
        }
        $jSON = $rawdata;
        return $jSON;
    }


    function updateItem($uuidItem, $name, $description) {
        $sql = "UPDATE ".$this::$ITEM_TABLE." SET ".$this::$ITEM_NAME." = ?, ".$this::$ITEM_DESCRIPTION." = ? WHERE ".$this::$ITEM_UUID." = ?";

        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($name, $description, $uuidItem))){
            return "ok";
        } else {
            return "ko";
        }
    }

     function createNewItem($uuid, $name, $description){
        $sql = "INSERT INTO ".$this::$ITEM_TABLE." (".$this::$ITEM_UUID.", ".$this::$ITEM_NAME.", ".$this::$ITEM_DESCRIPTION.") VALUES (?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid,$name,$description))){
            return "ok";
        } else {
            return "ko";
        }
    }


    function getItemByUUID($uuid){
        $sql = "SELECT * FROM ".$this::$ITEM_TABLE." WHERE ".$this::$ITEM_UUID." = ?" ;
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuid));
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
        }
        $jSON = $rawdata;
        return $jSON;
    }

    function deleteItem($uuid){
        $sql = "DELETE FROM ".$this::$ITEM_TABLE." WHERE ".$this::$ITEM_UUID." = ?";
        
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid))){
            return "ok";
        } else {
            return "ko";
        }
    }


    /** Usefull simple functions */
    function getConnection(){ return $this->conn; }
    function getDateStamp() { return date("d/m/y G:i:s"); }
    function redirectTo($url,$seconds){ echo '<META http-equiv="refresh" content="'.$seconds.';URL='.$url.'">'; }



}