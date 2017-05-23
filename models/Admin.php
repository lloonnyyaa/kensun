<?php

class Admin {

    public static function addParner($name, $address) {

        $coordinates = self::getParnerCoordinates($address);

        $db = Db::getConnection();
        $sql = 'INSERT INTO `pertners`(`name`, `address`, `latitude`, `longitude`) '
                . 'VALUES (:name, :address, :latitude, :longitude)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':address', $address, PDO::PARAM_STR);
        $result->bindParam(':latitude', $coordinates['lat'], PDO::PARAM_STR);
        $result->bindParam(':longitude', $coordinates['lng'], PDO::PARAM_STR);

        return $result->execute();
    }

    private static function getParnerCoordinates($address) {
        $address = str_replace(" ", "+", $address);
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address;
        $data = json_decode(file_get_contents($url), true);

        return $data["results"][0]['geometry']["location"];
    }

    public static function getConfig($name = null) {
        $db = Db::getConnection();

        if (is_null($name)) {
            $sql = 'SELECT * FROM `config` WHERE 1';
            $result = $db->prepare($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            return $result->fetchAll();
        } else {
            $sql = 'SELECT param FROM `config` WHERE name = :name';
            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            $data = $result->fetch();
            return $data['param'];
        }
    }

    public static function updateConfig($name, $value) {
        $db = Db::getConnection();

        $sql = 'UPDATE `config` SET `param`=:param WHERE `name`=:name';
        $result = $db->prepare($sql);
        $result->bindParam(':param', $value, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        
        return $result->execute();
    }

}
