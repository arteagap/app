<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends MY_Controller  {
	public function __construct()
	{
		 parent::__construct();
        $this->load->model('EmpresaModel');		 
	}

	public function index()
	{
		$data = array('titulo' => 'Empresa','token'  => $this->auth->token());		
		$this->layout('empresa/index_view',$data);
	}

	public function edit()
	{

		//Cargando Comprobantes
		$atrr=array('start' => 0 , 'limit' => JQRID_MAXROW, 'filter'=>"where IdEmpresa like '%".$this->auth->getidempresa()."%'");
		$empresa=$this->EmpresaModel->Listar('IdEmpresa',JQRID_ORDER_ASC,$atrr);
		$data = array('titulo' => 'Empresa','token'  => $this->auth->token(),'datempresa'=>$empresa[0]);
		$this->layout('empresa/edit_view',$data);
	}

	public function store() //Create, Update / Delete
	{
		//sleep(5);
		$response=array();
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
			$newnombrelogo="";
			$newnombrefirma="";
			$errimg		=0;
			$msgimg 	="";

			$request=$this->input->post();
        	$empresa=new EmpresaModel();
        	$empresa->opcion 		=isset($request["opcion"]) 	? $request["opcion"] : "";
        	$empresa->IdEmpresa		=$this->auth->getidempresa();//isset($request["idempresa"]) ? $request["idempresa"] : "" ;
        	$empresa->RUC			=isset($request["ruc"]) ? $request["ruc"] : "" ;
        	$empresa->RazonSocial	=isset($request["razon"]) ? $request["razon"] : "" ;
        	$empresa->razoncomercial=isset($request["comercial"]) ? $request["comercial"] : "" ;
        	$empresa->IdUbigeo		=isset($request["idubigeo"]) ? $request["idubigeo"] : "" ;
        	$empresa->Direccion		=isset($request["direccion"]) ? $request["direccion"] : "" ;
        	$empresa->telefono01	=isset($request["telefono01"]) ? $request["telefono01"] : "" ;
        	$empresa->telefono02	=isset($request["telefono02"]) ? $request["telefono02"] : "" ;
        	$empresa->email			=isset($request["email"]) ? $request["email"] : "" ;
        	$empresa->usuariosol	=isset($request["usuariosol"]) ? $request["usuariosol"] : "" ;
        	$empresa->clavesol		=isset($request["clavesol"]) ? $request["clavesol"] : "" ;
        	$empresa->clavefirma	=isset($request["clavefirma"]) ? $request["clavefirma"] : "" ;
        	$empresa->usuario		=$this->auth->getuser();
        	$logolast      			=isset($request["logolast"]) ? $request["logolast"] : "" ;
        	$firmalast      		=isset($request["firmalast"]) ? $request["firmalast"] : "" ;

			// Cargamos la libreria Upload
	        $this->load->library('upload');
			if (!empty($_FILES['logo']['name']))
	        {
	            $filelogo = $_FILES["logo"]["name"];
				$extlogo = substr(strrchr($filelogo,'.'),1);
	            $newnombrelogo=$this->random_string(50).'.'.$extlogo;
	            $config['upload_path'] = 'assets/sys/logos/';
	            $config['allowed_types'] = 'jpg|png';
	            $config['max_size'] = '1024';
	            $config['max_width']  = '1024';
	            $config['max_height']  = '768';  
	            $config['file_name']  = $newnombrelogo;
	            $this->upload->initialize($config);
	            if ($this->upload->do_upload('logo'))
	            {
        			$empresa->RutaLogo		=$newnombrelogo;            	
	            } //$data = $this->upload->data();
	            else
	            {
	                //echo $this->upload->display_errors();
	                $errimg++;
	                $msgimg=$msgimg. $this->upload->display_errors();
        			$empresa->RutaLogo		="";	                
	            }
	        }
	        else{
        		if (strlen($logolast)>0)
					$empresa->RutaLogo=$logolast;
				else
        			$empresa->RutaLogo="";
	        }    

	        //firma
			if (!empty($_FILES['firma']['name']))
	        {
	            $filelogo = $_FILES["firma"]["name"];
				$extlogo = substr(strrchr($filelogo,'.'),1);
	            $newnombrefirma=$this->random_string(50).'.'.$extlogo;
	            $configfirma['upload_path'] = 'assets/sys/firmas/';
	            $configfirma['allowed_types'] = '*';
	            $configfirma['max_size'] = '1024'; 
	            $configfirma['file_name']  = $newnombrefirma;
	            $this->upload->initialize($configfirma);
	            if ($this->upload->do_upload('firma'))
	            {
	                //$data = $this->upload->data();
        			$empresa->rutafirma		=$newnombrefirma;
	            }
	            else
	            {
	            	//echo "paso por aqui - mal";
	                echo $this->upload->display_errors();
	                $errimg++;
	                $msgimg=$msgimg.'<br>'.$this->upload->display_errors();
	                $empresa->rutafirma		="";
	            }
	        }else{
        		if (strlen($firmalast)>0)
					$empresa->rutafirma=$firmalast;
				else	        	
                	$empresa->rutafirma="";
	        }

        	$data=$this->EmpresaModel->registra($empresa);
			if ($data)
			{
				if ($data[0]->Code==0){
					$response=array('error'=>$data[0]->Code,'mensaje'=>$data[0]->Message,'id'=>$data[0]->Id);
					$this->session->userdata('rzempresa',$empresa->RazonSocial);
				}
				else{
					if ($errimg>0)
					{
						$response=array('error'=>$errimg,'mensaje'=>$data[0]->Message);
					}
					else{
						$response=array('error'=>$data[0]->Code,'mensaje'=>$data[0]->Message);		
					}
				}
			}
			else{
				$response=array('error'=>'1','mensaje'=>'Error');
			}

	   		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));			

        }		
	}

	private function random_string($length) { 
        $key = ''; 
        $keys = array_merge(range(0, 9), range('a', 'z')); 

        for ($i = 0; $i < $length; $i++) { 
         $key .= $keys[array_rand($keys)]; 
        } 

        return $key; 
    } 
}