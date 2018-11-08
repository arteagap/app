<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursal extends MY_Controller  {

	private $idempresa;
	private $usuario;	

	public function __construct()
	{
		parent::__construct();
        $this->load->model('SucursalModel');
	}

	public function index()
	{
		$data = array('titulo'=>'Sucursales','token'=>$this->auth->token());
		$this->layout('sucursal/index_view',$data);
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
            $datacount=$this->SucursalModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->SucursalModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
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

        	//print_r($request);

        	
        	$sucursal=new SucursalModel();
        	$sucursal->opcion 			=isset($request["opcion"]) 			? $request["opcion"] 	: "";
        	$sucursal->idsucursal		=isset($request["idsucursal"]) 	? $request["idsucursal"] 	: "0" ;
        	$sucursal->idempresa		=$this->auth->getidempresa();
        	$sucursal->nombre			=isset($request["nombre"]) ? $request["nombre"] 	: "";
        	$sucursal->direccion		=isset($request["direccion"]) ? $request["direccion"] 	: "";        	
        	$sucursal->ubigeo			=isset($request["codubigeo"]) ? $request["codubigeo"] 	: "";
        	$sucursal->codigosunat		=isset($request["codigosunat"]) ? $request["codigosunat"] 	: "";        	
        	$sucursal->usuario			=$this->auth->getuser();
        	$data=$this->SucursalModel->registra($sucursal);
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