<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Almacen extends MY_Controller  {

	private $idempresa;
	private $usuario;	

	public function __construct()
	{
		parent::__construct();
        $this->load->model('SucursalModel');		
        $this->load->model('AlmacenModel');
	}

	public function index()
	{

		//Listando Categorias
		$atrr=$this->grilla->param;
		$sucursal=$this->SucursalModel->Listar('idsucursal',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa()); //data

		$data = array('titulo'=>'Almacenes','token'=>$this->auth->token(),'sucursales'=>$sucursal);
		$this->layout('almacen/index_view',$data);
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
            $datacount=$this->AlmacenModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->AlmacenModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
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
        	$almacen=new AlmacenModel();
        	$almacen->opcion 		=isset($request["opcion"]) 		? $request["opcion"] 		: "";
        	$almacen->idalmacen		=isset($request["idalmacen"]) 	? $request["idalmacen"] 	: "0" ;
        	$almacen->idsucursal	=isset($request["sucursal"]) 	? $request["sucursal"] 		: "0" ;
        	$almacen->nombre		=isset($request["descripcion"]) ? $request["descripcion"] 	: "";
        	$almacen->ubicacion		=isset($request["ubicacion"]) 	? $request["ubicacion"] 	: "";
        	$almacen->usuario			=$this->auth->getuser();
        	$data=$this->AlmacenModel->registra($almacen);
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