<?php
class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=docker-mysql;dbname=swapp;charset=utf8', 'swapp', 'swapp');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}