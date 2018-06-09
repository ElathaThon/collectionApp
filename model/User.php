<?php


/**
 * This class manages all user elements
*/

class User {

    private static $USER_TABLE = "COLAPP_user";
    private static $USER_ID = "id";
    private static $USER_UUID = "uuid";
    private static $USER_GENDER = "gender";
    private static $USER_NICK = "name";
    private static $USER_EMAIL = "email";
    private static $USER_LAST_LOGIN = "lastlogin";


    private $dbh = NULL;

    function User(){

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


    function userExists($uuid){
        $sql = "SELECT * FROM ".$this::$USER_TABLE." WHERE ".$this::$USER_UUID." = ?" ;
        //echo "userExists: " . $sql;
        
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
        $sql = "INSERT INTO ".$this::$USER_TABLE." (".$this::$USER_UUID.", ".$this::$USER_GENDER.", ".$this::$USER_NICK.", ".$this::$USER_EMAIL.", ".$this::$USER_LAST_LOGIN.") VALUES (?,?,?,?,?)";
        //echo "newUser: " . $sql;

        $sth = $this->dbh->prepare($sql);

        $timestamp = $this->getDateStamp();

        if ($sth->execute(array($uuid, $gender, $name, $email, $timestamp))){
            return "ok";
        } else {
            return "ko";
        }
    }

    function updateLoginUser($uuid){
        $sql = "UPDATE ".$this::$USER_TABLE." SET ".$this::$USER_LAST_LOGIN." = ? WHERE ".$this::$USER_UUID." = ?";
        //echo "updateLoginUser: " . $sql;

        $timestamp = $this->getDateStamp();

        $sth = $this->dbh->prepare($sql);
        if ($sth->execute(array($timestamp, $uuid))){
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