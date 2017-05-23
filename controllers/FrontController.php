<?php

class FrontController {

    public function view() {
        require_once(ROOT . '/views/front.php');
        return true;
    }

    public function order() {
        $radius = Admin::getConfig('radius');
        $partners = Front::getPartnersRadius($radius);
        $customer_coordinates = Front::getCustomerCoordinates();

        $partners_coordinates = [];
        $i = 0;
        foreach ($partners as $partner) {
            $partners_coordinates[$i]['lat'] = (float)$partner["latitude"];
            $partners_coordinates[$i]['lng'] = (float)$partner["longitude"];
            $i++;
        }
        $partners_coordinates = json_encode($partners_coordinates);
        $answer = require_once(ROOT . '/views/partners_list.php');

        die($answer);
    }

    public function sendMail() {
        $radius = Admin::getConfig('radius');
        $partners = Front::getPartnersRadius($radius);

        $to = $_POST['email'];
        $subject = '=?utf-8?B?' . base64_encode('Список СТО-партнеров Kensun') . '?=';
        $message = "
        <html>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                <title>Список СТО-партнеров Kensun</title> 
            </head> 
            <body>
            <table>
                <thead>
                    <tr>
                        <th>Название</th><th>Адрес</th>
                    </tr>
                </thead>";

        foreach ($partners as $partner)
            $message .= "<tr><td>" . $partner['name'] . "</td><td>" . $partner['address'] . "</td></tr>";

        $message .= "</table>
             </body> 
        </html>";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Kensun <info@kensun.com.ua>' . "\r\n";

        if (mail($to, $subject, $message, $headers))
            $answer = '<div class="alert alert-success" role="alert"><strong>Данные успешно отправлены на указаный адрес</strong></div>';
        else
            $answer = '<div class="alert alert-danger" role="alert">Ошибка отправки почты</div>';

        die($answer);
    }

    public function test() {
        //var_dump(Front::getPartnersRarius(10));
    }

}
