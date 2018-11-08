<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends MY_Controller  {

	private $idempresa;
	private $usuario;	

	public function __construct()
	{
		 parent::__construct();
        $this->load->model('ProductoModel');
        $this->load->model('CategoriaModel');
        $this->load->model('UnidadmedidaModel');
        $this->load->model('TablasModel');
	}

	public function index()
	{
		//Listando Categorias
		$atrr=$this->grilla->param;
		$datcategoria=$this->CategoriaModel->Listar('idcategoria',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa()); //data

		//Lista Tablas
		$tiposproducto="002"; //Tabla Tipos Priductos
		$datatabla=$this->TablasModel->getdata($tiposproducto);

		//Lista Unidad Medida	
		$atrr=$this->grilla->param;
		$datumedida=$this->UnidadmedidaModel->Listar('idunidadmedida',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa()); //data

		$data = array('titulo'=>'Productos','token'=>$this->auth->token(),'categorias'=>$datcategoria,'tablas'=>$datatabla,'umedidas'=>$datumedida);
		$this->layout('producto/index_view',$data);
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
            $datacount=$this->ProductoModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->ProductoModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
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
        	$producto=new ProductoModel();
        	$producto->opcion 			=isset($request["opcion"]) 			? $request["opcion"] 	: "";
        	$producto->idproducto		=isset($request["idproducto"]) 	? $request["idproducto"] 	: "0" ;
        	$producto->idempresa		=$this->auth->getidempresa();
        	$producto->descripcion		=isset($request["descripcion"]) ? $request["descripcion"] 	: "";
        	$producto->codigotipo		=isset($request["tipo"]) 		? $request["tipo"] 			: "" ;
        	$producto->idcategoria		=isset($request["categoria"])	 ? $request["categoria"] 	: "0";
        	$producto->rutaimagen		='';
        	$producto->codigoreferencial=isset($request["codigoreferencia"]) ? $request["codigoreferencia"] : ""; 
        	$producto->idunidadmedida	=isset($request["umedida"]) ? $request["umedida"] : "0"; 
        	$producto->usuario			=$this->auth->getuser();
        	$data=$this->ProductoModel->registra($producto);
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