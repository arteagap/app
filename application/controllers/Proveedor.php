<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends MY_Controller  {

	private $idempresa;
	private $usuario;	

	public function __construct()
	{
		 parent::__construct();
        $this->load->model('ProveedorModel');
        $this->load->model('TablasModel');
	}

	public function index()
	{
		//Lista Tablas
		$tiposproducto="003"; //Tipo de Documentos
		$datatabla=$this->TablasModel->getdata($tiposproducto);

		$data = array('titulo'=>'Proveedores','token'=>$this->auth->token(),'tablas'=>$datatabla);
		$this->layout('proveedor/index_view',$data);
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
            $datacount=$this->ProveedorModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->ProveedorModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
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
        	$proveedor=new ProveedorModel();
			$proveedor->opcion 			=isset($request["opcion"]) 		? $request["opcion"] 	: "";
			$proveedor->idproveedor		=isset($request["idproveedor"]) 	? $request["idproveedor"] 	: "0" ;
			$proveedor->idempresa		=$this->auth->getidempresa();
			$proveedor->razonsocial		=isset($request["razonsocial"]) 		? $request["razonsocial"] 	: ""; 
			$proveedor->tipodocumento	=isset($request["tipodocumento"]) 		? $request["tipodocumento"] 	: ""; 
			$proveedor->nrodocumento	=isset($request["nrodocumento"]) 		? $request["nrodocumento"] 	: ""; 
			$proveedor->direccion		=isset($request["direccion"]) 		? $request["direccion"] 	: "";  
			$proveedor->ubigeo			=isset($request["codubigeo"]) 		? $request["codubigeo"] 	: "";  
			$proveedor->telefono		=isset($request["telefono"]) 		? $request["telefono"] 	: "";  
			$proveedor->celular			=isset($request["celular"]) 		? $request["celular"] 	: ""; 
			$proveedor->email 			=isset($request["email"]) 		? $request["email"] 	: ""; 
			$proveedor->usuario			=$this->auth->getuser();

        	$data=$this->ProveedorModel->registra($proveedor);
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