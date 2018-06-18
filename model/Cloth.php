<?php 

class Cloth extends Item {

    private static $ID_TYPE_VALUE = "1";

    public function __construct() {
        parent::__construct();
    }    

    public function getAllItems(){
        return parent::getAllItemsWithType($this::$ID_TYPE_VALUE);
    }

    public function update(){
        return parent::createNewItemWithType($this::$ID_TYPE_VALUE);
    }

    public function getUserClothes($uuidUser){
        return parent::getItemsFromUserUUIDWithType($uuidUser, $this::$ID_TYPE_VALUE);
    }

}

 ?>