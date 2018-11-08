<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends MY_Controller  {

	public function __construct()
	{
		 parent::__construct();		 
        $this->load->model('SucursalModel');			 
        $this->load->model('SeriesModel');	
        $this->load->model('ComprobantesModel');
        $this->load->model('MonedaModel');
        $this->load->model('TablasModel');        
        $this->load->model('VentaModel');  
        $this->load->model('CpeModel'); 
		$this->load->model('CpedetModel');         
	}

	public function index()
	{
		$data = array('titulo'=>'Ventas','token'=>$this->auth->token());
		$this->layout('ventas/index_view',$data);
	}

	public function emision($opc)
	{
		//Cargando Sucursales según Usuario
		$idsucursal=0;
		$sucursales=$this->SucursalModel->sucursalacceso($this->auth->getuser(),$this->auth->getidempresa());
		if (count($sucursales)>0)
			$idsucursal=$sucursales[0]->idsucursal;

		//Cargando Comprobantes
		$atrr=array('start' => 0 , 'limit' => JQRID_MAXROW, 'filter'=>"where codigosunat like '%".$opc."%'");
		$comprobantes=$this->ComprobantesModel->Listar('idcomprobantes',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa());

		$idcomprobante=0;
		if (count($comprobantes)>0)
			$idcomprobante=$comprobantes[0]->idcomprobantes;

		//Cargando las Series
		$series=$this->SeriesModel->seriesxcomprobantesucursal($this->auth->getidempresa(),$idsucursal,$idcomprobante);	

		//Cargando Monedas
		$atrr=$this->grilla->param;
		$monedas=$this->MonedaModel->Listar('idmoneda',JQRID_ORDER_ASC,$atrr,$this->auth->getidempresa());

		//Lista Tablas
		$codformapago="004"; //Tabla Formas de Pagos
		$formapagos=$this->TablasModel->getdata($codformapago);

		//Lista Tablas
		$operaciones=$this->TablasModel->gettipooperacion($this->auth->getidempresa());	

		//Tipo de Afectacion
		$afectaciones=$this->TablasModel->gettipoafectacion($this->auth->getidempresa());

		$data = array('titulo'=>'Ventas'
			,'token'=>$this->auth->token()
			,'sucursales'=>$sucursales
			,'comprobantes'=>$comprobantes
			,'series'=>$series
			,'monedas'=>$monedas
			,'formapagos'=>$formapagos
			,'operacion'=>$operaciones
			,'afectaciones'=>$afectaciones);
		$this->layout('ventas/emision_view',$data);		
	}

	public function store() //Create, Update / Delete
	{
		//sleep(5);
		$response=array();
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
        	$request=$this->input->post();    

			$venta=new VentaModel();

			$venta->idmovimiento=0;
			$venta->IdEmpresa=$this->auth->getidempresa();
			$venta->idsucursal=isset($request["idsucursal"]) 	? $request["idsucursal"] : "0" ;
			$venta->codigotipotransaccion="1";//isset($request["codigotipotransaccion"]) 	? $request["codigotipotransaccion"] : ""
			$venta->flgtipomovimiento="S";//isset($request["flgtipomovimiento"]) 	? $request["flgtipomovimiento"] : ""
			$venta->idcomprobantes=isset($request["tipocomprobante"]) 	? $request["tipocomprobante"] : "0";
			$venta->idmoneda=isset($request["idmoneda"]) 	? $request["idmoneda"] : "0";
			$venta->idcliente=isset($request["idcliente"]) 	? $request["idcliente"] : "0";
			$venta->idseries=isset($request["series"]) 	? $request["series"] : "0";
			$venta->nrocomprobante=isset($request["nrocomprobante"]) 	? $request["nrocomprobante"] : "";
			$venta->fechaemision=isset($request["fechaemision"]) 	? $request["fechaemision"] : "";
			$venta->fechavencimiento=isset($request["fechaemision"]) 	? $request["fechaemision"] : "";
			$venta->codtipooperacion=isset($request["codtipooperacion"]) 	? $request["codtipooperacion"] : "0";
			$venta->flgigv=isset($request["flgigv"]) 	? $request["flgigv"] : "0";
			$venta->valorigv=isset($request["inpvalorigv"]) 	? $request["inpvalorigv"] : "0";
			$venta->gravadas=isset($request["inpgravadas"]) 	? $request["inpgravadas"] : "0";
			$venta->dctoglobal=isset($request["inv-dcto-global"]) 	? $request["inv-dcto-global"] : "0";
			$venta->exonerada=isset($request["inpexonerada"]) 	? $request["inpexonerada"] : "0";
			$venta->inafectas=isset($request["inpinafectas"]) 	? $request["inpinafectas"] : "0";
			$venta->gratuitas=isset($request["inpgratuitas"]) 	? $request["inpgratuitas"] : "0";
			$venta->otroscargos=isset($request["inv-tot-otcargo"]) 	? $request["inv-tot-otcargo"] : "0";
			$venta->total=isset($request["inptotal"]) 	? $request["inptotal"] : "0";
			$venta->caddetalle=isset($request["caddetalle"]) 	? $request["caddetalle"] : "";
			$venta->usuario=$this->auth->getuser();              
        	$data=$this->VentaModel->registra($venta); 
        	       
			if ($data)
			{
				if ($data[0]->Code==0)
					$response=array('error'=>$data[0]->Code,'mensaje'=>$data[0]->Message,'id'=>$data[0]->Id,'nrodoc'=>$data[0]->Nrodoc);
				else
					$response=array('error'=>$data[0]->Code,'mensaje'=>$data[0]->Message);
			}
			else{
				$response=array('error'=>'1','mensaje'=>'Error');
			}

	   		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));				

        }
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
            $datacount=$this->VentaModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->VentaModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
            $json=$this->grilla->jq_getdata($this->input->get(),$data);
            echo $json;
        }
	}

	public function getserie()
	{
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
        	$request=$this->input->post();
        	$idsucursal=$request["idsucursal"];
        	$idcomprobante=$request["idcomprobante"];
			$series=$this->SeriesModel->seriesxcomprobantesucursal($this->auth->getidempresa(),$idsucursal,$idcomprobante);

			if ($series)
				$response=array('series'=>$series);
			else
				$response=array('series'=>false);	

	   		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));

		}		
	}

	public function rest()
	{      

		$dattocken = array("Username" => "admin","Password" => "123456");
       	$tok_ch = curl_init();
		curl_setopt_array($tok_ch, array(
		  CURLOPT_URL => "http://181.224.251.169:8282/WebSite/api/login/authenticate",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_FOLLOWLOCATION=>true,
		  CURLOPT_POSTFIELDS=>http_build_query($dattocken),
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		));
		$restoken = curl_exec($tok_ch);
		$errtoken = curl_error($tok_ch);
		curl_close($tok_ch);		

		$data=$this->VentaModel->getcabeceraventacpe(42);	
		$cpe=new CpeModel();
		$cpe->TIPO_COMPROBANTE						=$data[0]->comp_tipo;
		$cpe->EMISOR_RUC							=$data[0]->emp_ruc;
		$cpe->EMISOR_RAZON_SOCIAL					=$data[0]->emp_rz;
		$cpe->EMISOR_NOMBRE_COMERCIAL				=$data[0]->emp_rc;
		$cpe->EMISOR_TIPO_DOCUMENTO_IDENTIDAD		=$data[0]->emp_tipdocide;
		$cpe->EMISOR_COD_LOCAL_ANEXO				=$data[0]->emp_codlocal;
		$cpe->CLIENTE_TIPO_DOCUMENTO				=$data[0]->cli_tipdoc;
		$cpe->CLIENTE_NUMERO_DOCUNENTO				=$data[0]->cli_nrodoc;
		$cpe->CLIENTE_NOMBRE_RAZON_SOCIAL			=$data[0]->cli_razonsocial;
		$cpe->CPE_TIPO_MONEDA						=$data[0]->mnd_tipo;
		$cpe->CPE_TIPO_OPERACION					=$data[0]->tipo_operacion;
		$cpe->CPE_SERIE_NUMERO						=$data[0]->comp_nro_largo;
		$cpe->CPE_FECHA_EMISION						=$data[0]->comp_fechaemision;
		$cpe->CPE_HORA								=$data[0]->comp_horaemision;
		$cpe->CPE_IMPORTE_TOTAL_TRIBUTOS			=$data[0]->imp_valigv;
		$cpe->CPE_IMPORTE_GRAVADA_BASE_IMPONIBLE	=$data[0]->imp_basimp;
		$cpe->CPE_IMPORTE_GRAVADA_VALOR_IGV			=$data[0]->imp_valigv;
		$cpe->CPE_IMPORTE_EXPORTACIONES_SIN_IMPUESTOS="0.00";
		$cpe->CPE_IMPORTE_INAFECTA_SIN_CARGOS		=$data[0]->imp_inafectas;
		$cpe->CPE_IMPORTE_EXONERADA					=$data[0]->imp_exonerada;
		$cpe->CPE_IMPORTE_GRATUITAS_TOTAL 			=$data[0]->imp_gratuitas;
		$cpe->CPE_IMPORTE_GRATUITAS_TOTAL_IGV		="0.00";
		$cpe->CPE_TOTAL_VALOR_VENTA					=$data[0]->imp_basimp;
		$cpe->CPE_TOTAL_PRECIO_VENTA				=$data[0]->imp_total;
		$cpe->CPE_TOTAL_OTROS_CARGOS				=$data[0]->imp_otroscargos;
		$cpe->CPE_TOTAL_PAGAR						=$data[0]->imp_total;

		//Generando el Detalle
		$datadet=$this->VentaModel->getdetalleventacpe(42);	
		$arraydet=array();
		foreach ($datadet as $key => $value) {
			$cpedet=new CpedetModel();
			$cpedet->DET_ITEM						=$value->idmovimientodet;
			$cpedet->DET_UNIDAD_MEDIDA				=$value->umd_descripcion;
			$cpedet->DET_INDICADOR_INCLUYE_IGV		=false;
			$cpedet->DET_VALOR_UNITARIO				=$value->imp_valorunit;
			$cpedet->DET_PRECIO_UNITARIO			=$value->imp_preciounit;
			$cpedet->DET_CANTIDAD					=$value->cantidad;
			$cpedet->DET_IGV_LINEA_BASE_IMPONIBLE	=$value->imp_valorunit;
			$cpedet->DET_DESCUENTO_LINEA_TIPO		="OTROS_DESCUENTOS";
			$cpedet->DET_DESCUENTO_LINEA 			="0.00";
			$cpedet->DET_LINEA_VALOR_VENTA			=$value->imp_valorventa;
			$cpedet->DET_LINEA_PORCENTAJE_IGV 		="0.18";
			$cpedet->DEL_LINEA_IGV_OPERACION 		=$value->afect_nombre;
			$cpedet->DEL_LINEA_DESCRIPCION 			=$value->prd_nombre;
			$cpedet->DEL_CODIGO_PRODUCTO 			=$value->prd_codigo;
			array_push($arraydet,$cpedet);
		}
		$cpe->DETALLE=$arraydet;
		
		//echo json_encode($cpe);

		//echo json_encode($cpe);
		//print_r($cpe);

		
		
        $detalle=array(
			"DET_ITEM"=>"1",
			"DET_UNIDAD_MEDIDA"=>"UNIDAD_BIENES",
			"DET_INDICADOR_INCLUYE_IGV"=>false,
			"DET_VALOR_UNITARIO"=>"100.00",
			"DET_PRECIO_UNITARIO"=>"59.00",
			"DET_CANTIDAD"=>"2",
			"DET_IGV_LINEA_BASE_IMPONIBLE"=>"100.00",
			"DET_DESCUENTO_LINEA_TIPO"=>"OTROS_DESCUENTOS",
			"DET_DESCUENTO_LINEA"=>"0.00",
			"DET_LINEA_VALOR_VENTA"=>"100.00",
			"DET_LINEA_PORCENTAJE_IGV"=>"18.00",
			"DEL_LINEA_IGV_OPERACION"=>"GRAVADO_OPERACION_ONEROSA",
			"DEL_LINEA_DESCRIPCION"=>"PRODUCTO 01",
			"DEL_CODIGO_PRODUCTO"=>"COD001"        	
         );

        //Generando Comprobante
        $cabecera=array(
			"TIPO_COMPROBANTE"=>"01",
			"EMISOR_RUC"=>"20112316249",
			"EMISOR_RAZON_SOCIAL"=>"TEXTIL PACIFICO",
			"EMISOR_NOMBRE_COMERCIAL"=>"TEXTIL PACIFICO NMC",
			"EMISOR_TIPO_DOCUMENTO_IDENTIDAD"=>"6",
			"EMISOR_COD_LOCAL_ANEXO"=>"-",
			"CLIENTE_TIPO_DOCUMENTO"=>"6",
			"CLIENTE_NUMERO_DOCUNENTO"=>"20601450951",
			"CLIENTE_NOMBRE_RAZON_SOCIAL"=>"CODESI SAC",
			"CPE_TIPO_MONEDA"=>"PEN",
			"CPE_TIPO_OPERACION"=>"10",
			"CPE_SERIE_NUMERO"=>"F001-12121251",
			"CPE_FECHA_EMISION"=>"2018-10-24",
			"CPE_HORA"=>"00:00:00",
			"CPE_IMPORTE_TOTAL_TRIBUTOS"=>"23.40",
			"CPE_IMPORTE_GRAVADA_BASE_IMPONIBLE"=>"130.00",
			"CPE_IMPORTE_GRAVADA_VALOR_IGV"=>"23.40",
			"CPE_IMPORTE_EXPORTACIONES_SIN_IMPUESTOS"=>"0.00",
			"CPE_IMPORTE_INAFECTA_SIN_CARGOS"=>"0.00",
			"CPE_IMPORTE_EXONERADA"=>"0.00",
			"CPE_IMPORTE_GRATUITAS_TOTAL"=>"0.00",
			"CPE_IMPORTE_GRATUITAS_TOTAL_IGV"=>"0.00",
			"CPE_TOTAL_VALOR_VENTA"=>"130.00",
			"CPE_TOTAL_PRECIO_VENTA"=>"153.40",
			"CPE_TOTAL_OTROS_CARGOS"=>"0.00",
			"CPE_TOTAL_PAGAR"=>"153.40",
			"DETALLE"=>array($detalle)
         );       
		

        header('Content-Type: application/json');
		$post = json_encode($cabecera);
		echo $post;
       	$curlcpe = curl_init();
		curl_setopt_array($curlcpe, array(
		  CURLOPT_URL => "http://181.224.251.169:8282/WebSite/api/cpe",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_FOLLOWLOCATION=>true,
		  CURLOPT_POSTFIELDS=>$post,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer ' .str_replace('"','',$restoken),
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curlcpe);
		$err = curl_error($curlcpe);
		curl_close($curlcpe);
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  //echo $response;
		  $obj = json_decode($response);

			//$INPUT = "inputfile_base64_encoded.txt";
			$OUTPUT = "assets/files/prueba.xml";
			if (!file_exists($OUTPUT)) 
			{
				$bin = base64_decode($obj->XML);
				file_put_contents($OUTPUT, $bin);
			}
			//$contents = file_get_contents($INPUT);
			

		  //echo base_url();	
		  /*
		  $nombrefichero='prueba.xml';
          header('Content-type: text/xml; charset=utf-8');
          header('Content-Disposition: attachment; filename='.basename($nombrefichero));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize(base64_decode($obj->XML)));          
		  //echo utf8_encode(base64_decode($obj->XML));	
		  ob_clean();
		  flush();		  		  
		  exit;
		  */
		  /*
		  if(file_exists($nombrefichero)) 
			  {
			   //header('Content-Description: File Transfer');
			   //header('Content-Type: application/octet-stream');
			   header('Content-type: text/xml; charset=utf-8');
			   header('Content-Disposition: attachment; filename='.basename($nombrefichero));
			   header('Content-Transfer-Encoding: binary');
			   header('Expires: 0');
			   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			   header('Pragma: public');
			   header('Content-Length: ' . filesize($nombrefichero));
			   echo utf8_encode(base64_decode($obj->XML));
			   ob_clean();
			   flush();
			   readfile($nombrefichero);
			   exit;
			}
			*/
		  //print_r($obj);
		  //echo $obj->XML;		 
          
          /*
          header('Content-type: text/xml; charset=utf-8');
          header('Content-Disposition: attachment; filename="prueba.xml"');
		  echo utf8_encode(base64_decode($obj->XML));	
		  */
		  //$nombrefichero=
		  /*

			  */

		}
		
	}
}