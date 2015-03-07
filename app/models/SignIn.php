<?php
namespace Models;
use PDO;
session_start();


class SignIn{

    
    protected $db;

    public function __construct()
    {
        $this->db= self::getDB();
    }
    public static function getDB(){
        return new \PDO("mysql:dbname=blog; host=localhost", "root","php");
    }
    public static function signin()
    {   
        if(!isset( $_POST['username'], $_POST['password']))
        {
        $message = 'Please enter a valid username and password';
        }

        else
        {
        //data is valid and inserted in database 
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        // encrypt the password
        $password = sha1( $password );
    
    try
    {
       $db = self::getDB();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT  username, password FROM users 
                    WHERE username = :username AND password = :password");

        // bind the parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 20);
        
        $stmt->execute();

        if($username == false)
        {
                $message = 'Login Failed';
        }
        else
        {
                $_SESSION['username'] = $username;
                $message = 'You are now logged in';

        }


    }
    catch(Exception $e)
    {
        // wrong with the database
        $message = 'We are unable to process your request. Please try again later';
    }
   }
   return $message;
 }
}
?>
