<?php 
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=memobeer', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}