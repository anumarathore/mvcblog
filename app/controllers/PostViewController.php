<?php

namespace Controllers;
  
use Models\PostList;
class PostViewController
{	
	protected $twig;
	public function __construct(){
		$loader = new \Twig_Loader_Filesystem(__DIR__.'/../views');
		$this->twig = new \Twig_Environment($loader);
}

	public function get()
	{
		$post=PostList::getPosts();
		foreach ($post as $key => $value) {
			$d1= new \DateTime(); //global
			$d1->setTimestamp($value['created_at']);
			$post[$key]['date']= $d1->format('Y-m-d');
		}

		echo $this->twig->render("posts.html",array(
			"title"=>"Posts | MVC BLog",
			"posts"=> $post));
		
	}
	
}