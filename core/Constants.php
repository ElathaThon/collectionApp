<?php 

/**
* Les constants per a totes els fitxers, s'ha de possar un cop minim. I depsres per cridar a algun d'aquestes constants
* es un Constants::xxxxx el nom de la constant que volem. Exemple: $dbHost = Constants::$HOST;
*/
class Constants{

	public static $HOST = "localhost";
	public static $DATABASE = "collectionapp";
	public static $USER_NAME = "root";
	public static $PASSWORD = "";

	public static $ITEM_TABLE = "item";
	public static $ITEM_ID = "id";
	public static $ITEM_UUID = "uuid";
	public static $ITEM_NAME = "name";
	public static $ITEM_DESCRIPTION = "description";

	public static $IMAGE_TABLE = "image";
	public static $IMAGE_ID = "id";
	public static $IMAGE_UUID = "uuid";
	public static $IMAGE_UUID_ITEM = "uuidItem";
	public static $IMAGE_URL = "url";
	

}

?>	