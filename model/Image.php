<?php 

class Image {

	private static $IMAGE_TABLE = "COLAPP_image";
	private static $IMAGE_ID = "id";
	private static $IMAGE_UUID = "uuid";
	private static $IMAGE_UUID_ITEM = "uuidItem";
	private static $IMAGE_URL = "url";

	//Objectes de la classe
    private $dbh = NULL;

	public function __construct(){

        $dbHost = DbConnection::$HOST;
        $dbName = DbConnection::$DATABASE;
        $dbUser = DbConnection::$DB_USER_NAME;
        $dbPassword = DbConnection::$DB_PASSWORD;

        try {
            $this->dbh = new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }

    }


    /**
     * Creates a new image
     * @param $uuid
     * @param $uuidItem
     * @param $url
     * @return string
     */
    function createNewImage($uuid, $uuidItem, $url){
        $sql = "INSERT INTO ".$this::$IMAGE_TABLE." (".$this::$IMAGE_UUID.", ".$this::$IMAGE_UUID_ITEM.", ".$this::$IMAGE_URL.") VALUES (?,?,?)";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid,$uuidItem,$url))){
            return "ok";
        } else {
            return "ko";
        }
    }


    /**
     * Return all the images that have the item with the uuid given
     * @param $uuidItem
     * @return array
     */
    function getItemImages($uuidItem){
        $sql = "SELECT * FROM ".$this::$IMAGE_TABLE." WHERE ".$this::$IMAGE_UUID_ITEM." = ?" ;
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuidItem));
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
        }
        $jSON = $rawdata;
        return $jSON;
    }


    /**
     * Return the image that is the favorite from the item given
     * @param $uuidItem
     * @return array
     */
    function getFavoriteImage($uuidItem) {
        //$sql = "SELECT ".$this::$IMAGE_TABLE.".".$this::$IMAGE_URL." FROM ".$this::$IMAGE_TABLE." INNER JOIN ".$this::$ITEM_TABLE." ON ".$this::$ITEM_TABLE.".".$this::$ITEM_STAR_IMAGE." = ".$this::$IMAGE_TABLE.".".$this::$IMAGE_UUID." WHERE ".$this::$ITEM_TABLE.".".$this::$ITEM_UUID." = ?" ;

        $sql = "SELECT * FROM ".$this::$IMAGE_TABLE." INNER JOIN ".$this::$ITEM_TABLE." ON ".$this::$ITEM_TABLE.".".$this::$ITEM_STAR_IMAGE." = ".$this::$IMAGE_TABLE.".".$this::$IMAGE_UUID." WHERE ".$this::$ITEM_TABLE.".".$this::$ITEM_UUID." = ?" ;
        
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuidItem));
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
        }
        $jSON = $rawdata;
        return $jSON;
    }


    /**
     * Return the url of the image with the uuid given
     * @param $uuidImage
     * @return string
     */
    function getUrlImage($uuidImage) {
        $sql = "SELECT ".$this::$IMAGE_URL." FROM ".$this::$IMAGE_TABLE." WHERE ".$this::$IMAGE_UUID." = ?" ;
        //echo "Connection->getUrlImage: " . $sql;
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuidImage));
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
        }
        $jSON = $rawdata;
        return $jSON[0]['url'];
    }


    /**
     * Removes the image from the Database
     * @param $uuid
     * @return string
     */
    function deleteImage($uuid){
        $sql = "DELETE FROM ".$this::$IMAGE_TABLE." WHERE ".$this::$IMAGE_UUID." = ?";
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


 ?>