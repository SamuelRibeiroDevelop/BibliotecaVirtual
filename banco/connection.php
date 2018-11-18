<?php
/**
 * Created by PhpStorm.
 * User: samue
 * Date: 15/11/2018
 * Time: 14:23
 */

try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_biblioteca', 'root', '123456');
    $pdo-> exec("set names utf8");
} catch (PDOException $e){
    echo  'Erro ao conectar com o Banco: ' . $e->getMessage();
    exit(1);

}