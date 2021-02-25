<?php
class BDD
{
   static function dbConnect()
   {
      $database = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/public/config/bdd.ini');
      $host = $database['host'];
      $dbname = $database['dbname'];
      $username = $database['username'];
      $password = $database['password'];
      try {
         $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
         return $bdd;
      } catch (Exception $e) {
         die('Erreur : ' . $e->getMessage());
      }
   }
}
