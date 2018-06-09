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


    /**
     * Return an of all the items in the DDBB that are public
     * @return array
     */
    function getAllItems(){
        $sql = "SELECT * FROM ".$this::$ITEM_TABLE ." WHERE ".$this::$ITEM_PUBLIC ." = 1";
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


    /**
     * Update the item of the given uuid in the DDBB
     * @param $uuidItem
     * @param $name
     * @param $description
     * @return string
     */
    function updateItem($uuidItem, $name, $description) {
        $sql = "UPDATE ".$this::$ITEM_TABLE." SET ".$this::$ITEM_NAME." = ?, ".$this::$ITEM_DESCRIPTION." = ? WHERE ".$this::$ITEM_UUID." = ?";

        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($name, $description, $uuidItem))){
            return "ok";
        } else {
            return "ko";
        }
    }


    /**
     * Create a new item in the DDBB
     * @param $uuid
     * @param $name
     * @param $description
     * @return string
     */
    function createNewItem($uuid, $name, $description){
        $sql = "INSERT INTO ".$this::$ITEM_TABLE." (".$this::$ITEM_UUID.", ".$this::$ITEM_NAME.", ".$this::$ITEM_DESCRIPTION.") VALUES (?, ?, ?)";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid,$name,$description))){
            return "ok";
        } else {
            return "ko";
        }
    }


    /**
     * Return the item that have the given uuid
     * @param $uuid
     * @return array
     */
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


    /**
     * Delete the item with the given uuid from the DDBB
     * @param $uuid
     * @return string
     */
    function deleteItem($uuid){
        $sql = "DELETE FROM ".$this::$ITEM_TABLE." WHERE ".$this::$ITEM_UUID." = ?";
        
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid))){
            return "ok";
        } else {
            return "ko";
        }
    }


    /**
     * Update favorite image that have the item with the uuidGiven
     * @param $uuidItem
     * @param $uuidImage
     * @return string
     */
    function updateStarItemImage($uuidItem, $uuidImage) {
        $sql = "UPDATE ".$this::$ITEM_TABLE." SET ".$this::$ITEM_STAR_IMAGE." = ? WHERE ".$this::$ITEM_UUID." = ?";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuidImage, $uuidItem))){
            return "ok";
        } else {
            return "ko";
        }
    }


    /**
     * Return all the items that are from this user
     * @param $uuidUser
     * @return array
     */
    function getItemsFromUserUUID($uuidUser){
        $sql = "SELECT * FROM ".$this::$ITEM_TABLE." WHERE ".$this::$ITEM_USER_ID." = ?";
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuidUser));

        $i = 0;
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
            
            $uuidImage = $row['star_image'];
            $image = $this->image->getUrlImage($uuidImage);
            $rawdata[$i]['url'] = $image;
            
            $i++;
        }
        $jSON = $rawdata;
        return $jSON;
    }

    /**
     * Return the items in the database that are public, without the user public items
     * @param $uuidUser
     * @return array
     */
    function getPublicItemsWhitoutUserItems($uuidUser){
        $sql = "SELECT * FROM ".$this::$ITEM_TABLE." WHERE (NOT ".$this::$ITEM_USER_ID." = ? ) AND ".$this::$ITEM_PUBLIC." = 1";
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuidUser));
        
        $i = 0;
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
            
            $uuidImage = $row['star_image'];
            $image = $this->image->getUrlImage($uuidImage);
            $rawdata[$i]['url'] = $image;
            
            $i++;
        }
        $jSON = $rawdata;
        return $jSON;
    }


    

    /** Usefull simple functions */
    function getConnection(){ return $this->conn; }
    function getDateStamp() { return date("d/m/y G:i:s"); }
    function redirectTo($url,$seconds){ echo '<META http-equiv="refresh" content="'.$seconds.';URL='.$url.'">'; }



}