<?php

namespace Controllers;
  
use Models\SignUp;
class SignupController
{   
    protected $twig;
    public function __construct(){
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../views');
        $this->twig = new \Twig_Environment($loader);
}

    public function post()
    {
        
        $signup=SignUp::signup();
    //  if ($signin=== "You are now logged in")
        echo $this->twig->render("signup.html", array(
            'title'=> "Signup",
            'signup'=> $signup));
     //  else
      //  echo $this->twig->render("index.html", array("", 
       //     'signin' =>$signin));
    }
    
}