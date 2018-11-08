<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	 //comprobamos si el usuario está logueado
	 if($this->auth->is_logged() == TRUE)
	 {	
	 	redirect(base_url('home'));	 
	 }
	}

	public function index()
	{
	 //$this->load->view('login/index_view.php');
	 $data = array('titulo' => 'Login',
	   'token'  => $this->auth->token()       
	 );  

	 $this->load->view('login/index_view',$data);  	
	}

	//creamos la lógica para loguear a nuestros usuarios
	public function user_login()
	{ 
		$response=array();
		//si hacen submit al formulario	
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{ 
			//prevenimos ataques Cross-Site Request Forgery (CSRF)
		   if($this->input->post('token') == $this->session->userdata('token'))
		   {
				//si la validación del formulario falla
				//devolvemos al index mostrando los errores
				$ruc =$this->input->post('ruc');
				$login =$this->input->post('loggin');
				$password =$this->input->post('password');

				 //si falla la autentificación creamos una sesión flashdata
				 //para mostrar un mensaje y redirigimos con refresh
				 //al login de nuevo
				$result=$this->auth->login_user($ruc,$login,$password);
				if($result["error"]=="1"){						
					$response=$result;
				}else{			
					$this->auth->crear_sesiones($ruc,$login,$password);
					$response=array('error'=>'0','mensaje'=>'');
				} 
		   }
		   else{
				//$response=array('error'=>'1','mensaje'=>'Autenticación Incorrecta!');
		   		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
		   }
		   echo json_encode($response);			
		}else{
			$response=array('error'=>'1','mensaje'=>'Metodo incorrecto!');
			 $this->output->set_status_header(401)->set_content_type('application/json')->set_output(json_encode($response));
		} 		
	}
}