

<?php
    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.class.php';
    });

    /**
     * Hitta objektet i array som har samma id som input parametern id
     * returnera objektet som hade samma id
     */
    function findObj($objArray, $ID) {

        $currentObj;
        foreach($objArray as $Obj) {
            if($ID == $Obj->getID()) {
                $currentObj = $Obj;
            }
        }
        return $currentObj;
    }

?>