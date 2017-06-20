<?php
class Database
{

    $cleardb_url = parse_url( getenv( "CLEARDB_DATABASE_URL" ) );
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr( $cleardb_url["path"], 1 );


    // private static $dbName = 'bless_thee' ;
    // private static $dbHost = 'localhost' ;
    // private static $dbUsername = 'root';
    // private static $dbUserPassword = 'root';

    private static $dbName = $cleardb_db;
    private static $dbHost = $cleardb_server;
    private static $dbUsername = $cleardb_username;
    private static $dbUserPassword = $cleardb_password;
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>