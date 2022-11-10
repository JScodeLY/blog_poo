<?php

namespace App\Core;
//  j'importe PDO
use PDO;
use PDOException;


class Db extends PDO{
    // instance unique de la classe

    private static $instance;

    // information de connexions

    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = 'root';
    private const DBNAME = 'blog_poo';

    private function __construct(){
        //DSN de connexion
        $_dsn= 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;

        // j'appelle le constructeur de la classe PDO

        try {
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // à chaque fetch on récupère un tableau associatif (nomDeColonne => value)
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // definitions du mode d'erreur

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
// class avec un constructeur privé impossibillité de l'instancié directement 
// je devrais passer par une méthode static accessible par un '::' et vérifie s'il y a une instance
// si non existante il la créera si existante on la retourne

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self(); // new Db ou new de ma class elle mm
        }
        return self::$instance;
    }
// design pattern SINGLETON un constructeur privé et une methode static qui permet de générer une instance 
// s'il y en a pas ou de récupérer l'instance actuelle s'il y en a.
}


