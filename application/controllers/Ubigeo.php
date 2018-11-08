<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubigeo extends MY_Controller  {

	private $idempresa;
	private $usuario;	

	public function __construct()
	{
		 parent::__construct();
        $this->load->model('UbigeoModel');
	}

	public function index()
	{

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
            $datacount=$this->UbigeoModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //count
            $atrr=$this->grilla->jq_getatributes($this->input->get(),$datacount);
            //Obteniendo la Data
            $data=$this->UbigeoModel->Listar($sidx,$sord,$atrr,$this->auth->getidempresa()); //data
            $json=$this->grilla->jq_getdata($this->input->get(),$data);
            echo $json;
        }
	}
}