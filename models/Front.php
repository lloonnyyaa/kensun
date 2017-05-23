<?php

class Front {

    public static function getPartnersRadius($radius = 100) {
        $customer_coordinates = self::getCustomerCoordinates(); 
        $lat_customer = $customer_coordinates['latitude'];
        $lon_customer = $customer_coordinates['longitude'];
                
        $all_partners = self::getAllPartners();
        
        foreach($all_partners as $partner){
            $lat_partner = $partner["latitude"];
            $lon_partner = $partner["longitude"];
            $distance = self::getByDistance($lat_customer, $lon_customer, $lat_partner, $lon_partner);
            if($distance <= $radius * 1000)
                $partners[] = $partner;
        }
        
        return (isset($partners) ? $partners : 'Нет партнеров в данном регионе');
    }

    private static function getAllPartners() {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM `pertners` WHERE 1';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetchAll();
    }

    private static function getByDistance($lat_customer, $lon_customer, $lat_partner, $lon_partner) {
        $earth_radius = 6372795;
        
        $lat_customer = $lat_customer * M_PI / 180;
        $lon_customer = $lon_customer * M_PI / 180;
        $lat_partner = $lat_partner * M_PI / 180;
        $lon_partner = $lon_partner * M_PI / 180;
        
        $cos_customer = cos($lat_customer);
        $cos_partner = cos($lat_partner);
        $sin_customer = sin($lat_customer);
        $sin_partner = sin($lat_partner);
        
        $delta = $lon_customer - $lon_partner;
        
        $cdelta = cos($delta);
        $sdelta = sin($delta);
        
        $y = sqrt(pow($cos_partner * $sdelta, 2) + pow($cos_customer * $sin_partner - $sin_customer * $cos_partner * $cdelta, 2));
        $x = $sin_customer * $sin_partner + $cos_customer * $cos_partner * $cdelta;
        
        $ad = atan2($y, $x);
        $dist = $ad * $earth_radius;

        return $dist;        
    }

    public static function getCustomerCoordinates(){
        $test_ip = Admin::getConfig('ip');
        if(is_null($test_ip))
            $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
        else
            $ip = $test_ip;
        
        $gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);
        $record = GeoIP_record_by_addr($gi, $ip);
        $coordinates['latitude'] = $record->latitude;
        $coordinates['longitude'] = $record->longitude;
        geoip_close($gi);
        
        return $coordinates;
    }
}
