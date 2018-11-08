<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends MY_Controller  {

	private $idempresa;
	private $usuario;	

	public function __construct()
	{
		parent::__construct();
        $this->load->model('CategoriaModel');
	}

	public function index()
	{
		$data = array('titulo'=>'Categoria','token'=>$this->auth->token());
		$this->layout('categoria/index_view',$data);
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
            $datacount=$this->CategoriaModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->CategoriaModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
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
        	$categoria=new CategoriaModel();
        	$categoria->opcion 			=isset($request["opcion"]) 			? $request["opcion"] 	: "";
        	$categoria->idcategoria		=isset($request["idcategoria"]) 	? $request["idcategoria"] 	: "0" ;
        	$categoria->idempresa		=$this->auth->getidempresa();
        	$categoria->descripcion		=isset($request["descripcion"]) ? $request["descripcion"] 	: "";
        	$categoria->usuario			=$this->auth->getuser();
        	$data=$this->CategoriaModel->registra($categoria);
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