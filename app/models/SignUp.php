<?php
namespace Models;
use PDO;


class SignUp{
     
    public static function signup(){


    if(!isset( $_POST['username'], $_POST['password']))
    {
        echo $message = 'Please enter a valid username and password';
    }

    elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
    {
    echo $message = 'Incorrect Length for Username';
    }

    elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
    {
    echo $message = 'Incorrect Length for Password';
    }
 
    else
{
    // data is valid and inserted into database 
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    // encrypt the password 
    $password = sha1( $password );
    
    $mysql_hostname = 'localhost';
 
    $mysql_username = 'root';
 
    $mysql_password = 'php';
 
    $mysql_dbname = 'blog';

    try
    {
        $dbh = new \PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     

        $stmt = $dbh->prepare("INSERT INTO users (username, password ) VALUES (:username, :password )");

        // bind the parameters PDO
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 40);

        // execute the prepared statement 
        $stmt->execute();

        $message = "Congratulations! You have been added as a user";
    

        echo $message ;
    }
    catch(Exception $e)
    {
        // if username already exists 
        if( $e->getCode() == 23000)
        {
            echo $message = 'Sorry!Username already exists';
        }
        else
        {
            // wrong with the database 
            echo $message = 'We are unable to process your request right now. Please try again later"';
        }
    }
    }  
  
}
}
?>
