<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Series extends MY_Controller  {

	private $idempresa;
	private $usuario;	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ComprobantesModel');
		$this->load->model('SucursalModel');
        $this->load->model('SeriesModel');
	}

	public function index()
	{
		//Listando Sucursales
		$atrr=$this->grilla->param;
		$datcategoria=$this->SucursalModel->Listar('idsucursal',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa()); 

		//Listado de Comprobantes
		$atrr=$this->grilla->param;
		$datcomprobante=$this->ComprobantesModel->Listar('idcomprobantes',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa()); 			

		$data = array('titulo'=>'Series','token'=>$this->auth->token(),'sucursales'=>$datcategoria,'comprobantes'=>$datcomprobante);
		$this->layout('series/index_view',$data);
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
            $datacount=$this->SeriesModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->SeriesModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
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
        	$series=new SeriesModel();
        	$series->opcion 			=isset($request["opcion"]) 			? $request["opcion"] 	: "";
        	$series->idseries		=isset($request["idseries"]) 	? $request["idseries"] 	: "0" ;
        	$series->idsucursal		=isset($request["idsucursal"]) 	? $request["idsucursal"] 	: "0" ;
        	$series->idcomprobantes		=isset($request["idcomprobantes"]) ? $request["idcomprobantes"] : "0";
			$series->codigoserie		=isset($request["codigoserie"]) ? $request["codigoserie"] 	: "";
        	$series->correlativo		=isset($request["correlativo"]) ? $request["correlativo"] 	: "0";
        	$series->loingitudcorrelativo=isset($request["longitudcorrelativo"]) ? $request["longitudcorrelativo"] 	: "0";
        	$series->usuario			=$this->auth->getuser();
        	$data=$this->SeriesModel->registra($series);
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