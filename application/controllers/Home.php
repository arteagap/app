<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller  {
	public function __construct()
	{
		 parent::__construct();
	}

	public function index()
	{
		$data = array('titulo' => 'Home','token'  => $this->auth->token());		
		$this->layout('home_view',$data);
	}

	 //cerramos sesión llamando a la función logout
	 //nuestra librería
	 public function logout_user()
	 {	 
	 	$this->auth->logout();	 
	 }		
}