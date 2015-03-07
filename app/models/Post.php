<?php

namespace Models;

class Post
{
	protected $db;

	public function __construct()
	{
		$this->db= self::getDB();
	}
	public static function getDB(){
		return new \PDO("mysql:dbname=blog; host=localhost", "root","php");
	}
	public static function create($title, $content)
	{   $db = self::getDB();
		$time = time();
		$statement=
		$db->prepare("INSERT INTO posts (title,content,created_at) VALUES(:title, :content, :created_at)");
		$result = $statement->execute(array(
			"title"=> $title,
			"content"=> $content,
			"created_at"=> $time
			));
		if($result)
		{
			return true;
		}
		else
		{
			echo 'Error occured!!!';
			var_dump( $statement->errorInfo());
		}
	}
}