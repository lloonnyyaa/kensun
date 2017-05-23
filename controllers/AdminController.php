<?php

class AdminController {
    public function view() {
        $radius = Admin::getConfig('radius');
        $ip = Admin::getConfig('ip');
        require_once(ROOT . '/views/admin.php');

        return true;
    }
    
    public function addPartner(){
        $name = $_POST['partner_name'];
        $address = $_POST['partner_address'];
        $res = Admin::addParner($name, $address);
        if($res)
            $answer = '<div class="alert alert-success" role="alert"><strong>Партнер успешно добавлен</strong></div>';
        else
            $answer = '<div class="alert alert-danger" role="alert">Ошибка добавления</div>';
                     
        die($answer);
    }
    
    public function updateConfig(){
        foreach($_POST as $key => $value){
            if($value == '')
                $value = null;
            Admin::updateConfig($key, $value);
        }
        
        die('<div class="alert alert-success" role="alert"><strong>Конфигурация обновлена</strong></div>');

    }
}
