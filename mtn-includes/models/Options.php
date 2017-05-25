<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 11.05.17
 * Time: 18:37
 */
class Options
{
    public static function getOptionsList()
    {
        $DBConnection = Database::getDBConnection();

        $query = 'SELECT * FROM `' . DB_PREFIX . 'options`';

        $result = $DBConnection->prepare($query);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function initSystemOptions()
    {
        $optionsList = self::getOptionsList();

        foreach($optionsList as $option){
            define($option['option_name'],$option['option_value']);
        }
    }

    public static function updateSystemOptions($optionList)
    {
        $DBConnection = Database::getDBConnection();

        $query = 'UPDATE ' . DB_PREFIX . 'options SET option_value = :value WHERE option_name = :name';

        foreach($optionList as $key => $option){
            $result = $DBConnection->prepare($query);
            $result->bindParam(':name', $key, PDO::PARAM_STR);
            $result->bindParam(':value', $option, PDO::PARAM_STR);
            if($result->execute()){
                $return = true;
            } else {
                return false;
            }
        }

    }
}