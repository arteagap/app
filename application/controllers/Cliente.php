<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller  {

	private $idempresa;
	private $usuario;	

	public function __construct()
	{
		 parent::__construct();
        $this->load->model('ClienteModel');
        $this->load->model('TablasModel');
	}

	public function index()
	{
		//Lista Tablas
		$tiposproducto="003"; //Tipo de Documentos
		$datatabla=$this->TablasModel->getdata($tiposproducto);

		$data = array('titulo'=>'Clientes','token'=>$this->auth->token(),'tablas'=>$datatabla);
		$this->layout('cliente/index_view',$data);
	}

	public function list()
	{
		$response=array();
        if ($this->input->server('REQUEST_METHOD') == 'GET')
        {
            $sidx =$_GET['sidx'];
            $sord =$_GET['sord'];
            $atrr=$this->grilla->param;
            //Obteniendo el Count
            $datacount=$this->ClienteModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->ClienteModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
            $json=$this->grilla->jq_getdata($this->input->get(),$data);
            echo $json;
        }
	}

	public function store() //Create, Update / Delete
	{
		//sleep(5);
		$response=array();
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
        	$request=$this->input->post();
        	$cliente=new ClienteModel();
			$cliente->opcion 			=isset($request["opcion"]) 		? $request["opcion"] 	: "";
			$cliente->idcliente		=isset($request["idcliente"]) 	? $request["idcliente"] 	: "0" ;
			$cliente->idempresa		=$this->auth->getidempresa();
			$cliente->paterno 			=isset($request["paterno"]) 		? $request["paterno"] 	: "";
			$cliente->materno 			=isset($request["materno"]) 		? $request["materno"] 	: "";
			$cliente->nombres			=isset($request["nombres"]) 		? $request["nombres"] 	: "";
			$cliente->razonsocial		=isset($request["razonsocial"]) 		? $request["razonsocial"] 	: ""; 
			$cliente->tipodocumento	=isset($request["tipodocumento"]) 		? $request["tipodocumento"] 	: ""; 
			$cliente->nrodocumento		=isset($request["nrodocumento"]) 		? $request["nrodocumento"] 	: ""; 
			$cliente->direccion		=isset($request["direccion"]) 		? $request["direccion"] 	: "";  
			$cliente->ubigeo			=isset($request["codubigeo"]) 		? $request["codubigeo"] 	: "";  
			$cliente->telefono			=isset($request["telefono"]) 		? $request["telefono"] 	: "";  
			$cliente->celular			=isset($request["celular"]) 		? $request["celular"] 	: ""; 
			$cliente->email 			=isset($request["email"]) 		? $request["email"] 	: ""; 
			$cliente->usuario			=$this->auth->getuser();

        	$data=$this->ClienteModel->registra($cliente);
			if ($data)
			{
				if ($data[0]->Code==0)
					$response=array('error'=>$data[0]->Code,'mensaje'=>$data[0]->Message,'id'=>$data[0]->Id);
				else
					$response=array('error'=>$data[0]->Code,'mensaje'=>$data[0]->Message);
			}
			else{
				$response=array('error'=>'1','mensaje'=>'Error');
			}

	   		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
        }		
	}
}