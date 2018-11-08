<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends MY_Controller  {

	public function __construct()
	{
		 parent::__construct();	
        $this->load->model('SucursalModel');		 
        $this->load->model('ComprobantesModel');	
        $this->load->model('MonedaModel');
        $this->load->model('CompraModel');
        $this->load->model('AlmacenModel');        
	}
	public function index()
	{	
		$data = array('titulo'=>'Compras','token'=>$this->auth->token());
		$this->layout('compras/index_view',$data);
	}
	public function registro()
	{	

		/*
		$ruta="assets/sys/firmas/a0zyaoytupd9xo04q7zlf3joitt77k7lodb8m2cbv1xrr2ir8c.pfx";
		$b64=base64_encode(file_get_contents($ruta));
		//print_r($b64);

	     header('Content-type: application/pfx; charset=utf-8');
	     header('Content-Disposition: attachment; filename="firma.pfx"');
	     echo base64_decode($b64);
	     */

		//Cargando Sucursales según Usuario
		$idsucursal=0;
		$sucursales=$this->SucursalModel->sucursalacceso($this->auth->getuser(),$this->auth->getidempresa());
		if (count($sucursales)>0)
			$idsucursal=$sucursales[0]->idsucursal;

		//Cargando Comprobantes
		$atrr=array('start' => 0 , 'limit' => JQRID_MAXROW, 'filter'=>"where flgcompra like '%1%'");
		$comprobantes=$this->ComprobantesModel->Listar('idcomprobantes',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa());

		//Cargando Almacen Destino
		$atrr=array('start' => 0 , 'limit' => JQRID_MAXROW, 'filter'=>"where idsucursal='".$idsucursal."'");
		$almacenes=$this->AlmacenModel->Listar('idalmacen',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa());			

		//Cargando Monedas
		$atrr=$this->grilla->param;
		$monedas=$this->MonedaModel->Listar('idmoneda',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa());		

		$data = array('titulo'=>'Nueva Compra'
					,'token'=>$this->auth->token()
					,'comprobantes'=>$comprobantes
					,'monedas'=>$monedas	
					,'sucursales'=>$sucursales
					,'almacenes'=>$almacenes
					);

		$this->layout('compras/registro_view',$data);
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
            $datacount=$this->CompraModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->CompraModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
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

			$compra=new CompraModel();

			$compra->idmovimiento=0;
			$compra->IdEmpresa=$this->auth->getidempresa();
			$compra->idsucursal=isset($request["idsucursal"]) 	? $request["idsucursal"] : "0" ;
			$compra->codigotipotransaccion="2";// Compras
			$compra->flgtipomovimiento="I";//isset($request["flgtipomovimiento"]) 	? $request["flgtipomovimiento"] : ""
			$compra->idcomprobantes=isset($request["tipocomprobante"]) 	? $request["tipocomprobante"] : "0";
			$compra->idmoneda=isset($request["idmoneda"]) 	? $request["idmoneda"] : "0";
			$compra->idproveedor=isset($request["idproveedor"]) 	? $request["idproveedor"] : "0";
			$compra->codserie=isset($request["series"]) 	? $request["series"] : "0";
			$compra->nrocomprobante=isset($request["nrocomprobante"]) 	? $request["nrocomprobante"] : "";
			$compra->fechaemision=isset($request["fechaemision"]) 	? $request["fechaemision"] : "";
			$compra->fechavencimiento=isset($request["fechaemision"]) 	? $request["fechaemision"] : "";
			$compra->gravadas=isset($request["inpbaseimponible"]) 	? $request["inpbaseimponible"] : "0";
			$compra->valorigv=isset($request["inpigv"]) 	? $request["inpigv"] : "0";			
			$compra->total=isset($request["inppreciocompra"]) 	? $request["inppreciocompra"] : "0";
			$compra->caddetalle=isset($request["caddetalle"]) 	? $request["caddetalle"] : "";
			$compra->usuario=$this->auth->getuser();
        	$data=$this->CompraModel->registra($compra);

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