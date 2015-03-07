<?php

namespace Models;

class PostList
{
	protected $db;

	public function __construct()
	{
		$this->db= self::getDB();
	}
	public static function getDB(){
		return new \PDO("mysql:dbname=blog; host=localhost", "root","php");
	}
	public static function getPosts()
	{   $db = self::getDB();
		$time = time();
		$post =array();
		$statement=
		$db->prepare("SELECT * FROM posts order by created_at desc");
		$result = $statement->execute();
		if($result)
		{	
			while($row = $statement->fetch(\PDO::FETCH_ASSOC))
			{
			$post[]=$row;}
			return $post;
		
	}
		else
		{
			echo 'Error occured!!!';
			var_dump( $statement->errorInfo());
		}
	}
}
