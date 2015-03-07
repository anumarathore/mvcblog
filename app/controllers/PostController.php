<?php

namespace Controllers;
  
use Models\Post;
class PostController
{	
	protected $twig;
	public function __construct(){
		$loader = new \Twig_Loader_Filesystem(__DIR__.'/../views');
		$this->twig = new \Twig_Environment($loader);
}

	public function get()
{
		echo $this->twig->render("create.html", array(
			"title"=> "MVC Blog",
			"message" => array("There","You","Go")
			));
	}
	public function post(){
		$title = $_POST['title'];
		$content= $_POST['content'];
		$created= Post::create($title,$content);
		echo $this->twig->render("create.html", array(
			"title"=> "MVC Blog",
			"message" => array("There","You","Go")
			));
	}
}
?>