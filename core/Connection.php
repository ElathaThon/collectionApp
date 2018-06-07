<?php


class Connection {

    private $dbh = NULL;

    function Connection(){

        $dbHost = Constants::$HOST;
        $dbName = Constants::$DATABASE;
        $dbUser = Constants::$DB_USER_NAME;
        $dbPassword = Constants::$DB_PASSWORD;
        
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
        //echo "Dins del getAllitems SQL: " . $sql;
        
        $sth->execute(array());
        $rawdata = array();
        $i = 0;
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
            $uuidImage = $row['star_image'];

            $image = $this->getUrlImage($uuidImage);
            $rawdata[$i]['url'] = $image;

            //print_r($rawdata);
            $i++;
        }
        $jSON = $rawdata;
        return $jSON;
    }

    function getItemByUUID($uuid){
        $sql = "SELECT * FROM ".Constants::$ITEM_TABLE." WHERE ".Constants::$ITEM_UUID." = ?" ;
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
        $sql = "DELETE FROM ".Constants::$ITEM_TABLE." WHERE ".Constants::$ITEM_UUID." = ?";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid))){
            return "ok";
        } else {
            return "ko";
        }
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

    function getItemImages($uuidItem){
        $sql = "SELECT * FROM ".Constants::$IMAGE_TABLE." WHERE ".Constants::$IMAGE_UUID_ITEM." = ?" ;
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuidItem));
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
        }
        $jSON = $rawdata;
        return $jSON;
    }

    function updateStarItemImage($uuidItem, $uuidImage) {
        $sql = "UPDATE ".Constants::$ITEM_TABLE." SET ".Constants::$ITEM_STAR_IMAGE." = ? WHERE ".Constants::$ITEM_UUID." = ?";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuidImage, $uuidItem))){
            return "ok";
        } else {
            return "ko";
        }
    }


    function getFavoriteImage($uuidItem) {
        //$sql = "SELECT ".Constants::$IMAGE_TABLE.".".Constants::$IMAGE_URL." FROM ".Constants::$IMAGE_TABLE." INNER JOIN ".Constants::$ITEM_TABLE." ON ".Constants::$ITEM_TABLE.".".Constants::$ITEM_STAR_IMAGE." = ".Constants::$IMAGE_TABLE.".".Constants::$IMAGE_UUID." WHERE ".Constants::$ITEM_TABLE.".".Constants::$ITEM_UUID." = ?" ;

        $sql = "SELECT * FROM ".Constants::$IMAGE_TABLE." INNER JOIN ".Constants::$ITEM_TABLE." ON ".Constants::$ITEM_TABLE.".".Constants::$ITEM_STAR_IMAGE." = ".Constants::$IMAGE_TABLE.".".Constants::$IMAGE_UUID." WHERE ".Constants::$ITEM_TABLE.".".Constants::$ITEM_UUID." = ?" ;
        
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuidItem));
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
        }
        $jSON = $rawdata;
        return $jSON;
    }


    function getUrlImage($uuidImage) {
        $sql = "SELECT ".Constants::$IMAGE_URL." FROM ".Constants::$IMAGE_TABLE." WHERE ".Constants::$IMAGE_UUID." = ?" ;
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuidImage));
        $rawdata = array();
        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rawdata[] = $row;
        }
        $jSON = $rawdata;
        return $jSON[0]['url'];
    }


    function updateItem($uuidItem, $name, $description) {
        $sql = "UPDATE ".Constants::$ITEM_TABLE." SET ".Constants::$ITEM_NAME." = ?, ".Constants::$ITEM_DESCRIPTION." = ? WHERE ".Constants::$ITEM_UUID." = ?";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($name, $description, $uuidItem))){
            return "ok";
        } else {
            return "ko";
        }
    }

    function deleteImage($uuid){
        $sql = "DELETE FROM ".Constants::$IMAGE_TABLE." WHERE ".Constants::$IMAGE_UUID." = ?";
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($uuid))){
            return "ok";
        } else {
            return "ko";
        }
    }


    function userExists($uuid){
        $sql = "SELECT * FROM ".Constants::$USER_TABLE." WHERE ".Constants::$USER_UUID." = ?" ;
        
        $sth = $this->dbh->prepare($sql);
        $sth->execute(array($uuid));
        
        if($sth->rowCount() > 0){
            $this->updateLoginUser($uuid);
            return true;
        } else {
            return false;
        }
    }


    function newUser($uuid, $gender, $name, $email){
        $sql = "INSERT INTO ".Constants::$USER_TABLE." (".Constants::$USER_UUID.", ".Constants::$USER_GENDER.", ".Constants::$USER_NICK.", ".Constants::$USER_EMAIL.", ".Constants::$USER_LAST_LOGIN.") VALUES (?,?,?,?,?)";
        $sth = $this->dbh->prepare($sql);

        $timestamp = $this->getDateStamp();

        if ($sth->execute(array($uuid, $gender, $name, $email, $timestamp))){
            return "ok";
        } else {
            return "ko";
        }
    }

    function updateLoginUser($uuid){
        $sql = "UPDATE ".Constants::$USER_TABLE." SET ".Constants::$USER_LAST_LOGIN." = ? WHERE ".Constants::$USER_UUID." = ?";

        $timestamp = $this->getDateStamp();

        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($timestamp, $uuid))){
            return "ok";
        } else {
            return "ko";
        } 
    }






    function getDateStamp() {

    $date_array = getdate();
    $formated_date .= $date_array['mday'] . "/";
    $formated_date .= $date_array['mon'] . "/";
    $formated_date .= $date_array['year'];
    //return $formated_date;

    return date("d/m/y G:i:s");

    }


}


?>