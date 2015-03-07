<?php
require_once __DIR__ ."/../vendor/autoload.php";

Toro::serve(array(
	"/" => "Controllers\\HomeController",
	"/create" => "Controllers\\PostController",
	"/posts" => "Controllers\\PostViewController",
	"/user" => "Controllers\\SignInController",
	"/signup" =>"Controllers\\SignupController"

		)); 
