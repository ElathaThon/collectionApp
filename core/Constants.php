<?php 

/**
* Les constants per a totes els fitxers, s'ha de possar un cop minim. I depsres per cridar a algun d'aquestes constants
* es un Constants::xxxxx el nom de la constant que volem. Exemple: $dbHost = Constants::$HOST;
*/
class Constants{

    public static $USER_TABLE = "COLAPP_user";
    public static $USER_ID = "id";
    public static $USER_UUID = "uuid";
    public static $USER_GENDER = "gender";
    public static $USER_NICK = "name";
    public static $USER_EMAIL = "email";
    public static $USER_LAST_LOGIN = "lastlogin";

    public static $ITEM_TABLE = "COLAPP_item";
    public static $ITEM_ID = "id";
    public static $ITEM_UUID = "uuid";
    public static $ITEM_NAME = "name";
    public static $ITEM_DESCRIPTION = "description";
    public static $ITEM_STAR_IMAGE = "star_image";
    public static $ITEM_USER_ID = "userID";
    public static $ITEM_PUBLIC = "public";

	public static $IMAGE_TABLE = "COLAPP_image";
	public static $IMAGE_ID = "id";
	public static $IMAGE_UUID = "uuid";
	public static $IMAGE_UUID_ITEM = "uuidItem";
	public static $IMAGE_URL = "url";
	


}

?>	