<?php

class Db {

    public static function getConnection() {
        $params = self::params();

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        $db->exec("set names utf8");

        return $db;
    }

    private static function params() {
        return [
            'host' => 'insiders.mysql.ukraine.com.ua',
            'dbname' => 'insiders_develop',
            'user' => 'insiders_develop',
            'password' => '8s1cp47a',
        ];
    }

}
