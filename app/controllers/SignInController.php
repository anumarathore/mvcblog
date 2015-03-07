<?php

namespace Controllers;
  
use Models\SignIn;
class SignInController
{   
    protected $twig;
    public function __construct(){
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../views');
        $this->twig = new \Twig_Environment($loader);
}

    public function post()
    {
        
        $signin=SignIn::signin();
      if ($signin=== "You are now logged in")
        echo $this->twig->render("user.html", array(
            'title'=> "HomePage",
            'signin'=> $signin));
       else
        echo $this->twig->render("index.html", array("", 
            'signin' =>$signin));
    }
    
}