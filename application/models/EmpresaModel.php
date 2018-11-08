<?php
Class EmpresaModel extends CI_Model
{

	private $key='IdEmpresa';
	private $table = 'comprobantes';

	public $opcion; //Nuevo / Editar / Eliminar
	public $IdEmpresa;
	public $RUC;
	public $RazonSocial;
	public $razoncomercial;
	public $IdUbigeo;
	public $Direccion;
	public $telefono01;
	public $telefono02;
	public $email;
	public $RutaLogo;
	public $usuariosol;
	public $clavesol;
	public $rutafirma;
	public $clavefirma;
	public $usuario;

	function getdataempresa($ruc)
	{
		$this ->db->select('*');
		$this ->db->from('empresa');
		$this ->db->where('ruc = '. "'". $ruc."'"); 
		$this ->db->limit(1);
        $q = $this ->db-> get();
		if($q -> num_rows() == 1)
		{
             //mysqli_next_result($this->db->conn_id);
             $data = $q->result();
             $q->free_result();
            return $data;
		}
		else
		{
			return false;
		}
	}

	function Listar($sidx,$sord,$attr)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"]);
		$sql = 'CALL sp_get_listaempresaall(?,?,?,?,?)';
		$q = $this->db->query($sql, $parameters);
		if($q -> num_rows() >= 1)
		{
             mysqli_next_result($this->db->conn_id);
             $data = $q->result();
             $q->free_result();
             return $data;
		}
		else
		{
			return false;
		}		
	}

	function registra (EmpresaModel $data)
	{
		$parameters=array($data->opcion//Nuevo / Editar / Eliminar
						,$data->IdEmpresa
						,$data->RUC
						,$data->RazonSocial
						,$data->razoncomercial
						,$data->IdUbigeo
						,$data->Direccion
						,$data->telefono01
						,$data->telefono02
						,$data->email
						,$data->RutaLogo
						,$data->usuariosol
						,$data->clavesol
						,$data->rutafirma
						,$data->clavefirma
						,$data->usuario
						);
		$sql = 'CALL sp_set_registraempresa(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
		$q = $this->db->query($sql, $parameters);
		if($q -> num_rows() >= 1)
		{
             mysqli_next_result($this->db->conn_id);
             $data = $q->result();
             $q->free_result();
             return $data;
		}
		else
		{
			return false;
		}
	}

}