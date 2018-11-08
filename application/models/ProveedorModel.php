<?php
Class ProveedorModel extends CI_Model
{

	private $key='idproveedor';
	private $table = 'proveedor';

	public $opcion; //Nuevo / Editar / Eliminar
	public $idproveedor;
	public $idempresa;
	public $razonsocial;
	public $tipodocumento;
	public $nrodocumento;
	public $direccion;
	public $ubigeo;
	public $telefono;
	public $celular;
	public $email;

	public $usuario;

	function Listar($sidx,$sord,$attr,$idempresa)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"],$idempresa);
		$sql = 'CALL sp_get_listaproveedorall(?,?,?,?,?,?)';
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

	function Obtener($idproducto,$idempresa)
	{
		$where="WHERE ".$key." LIKE '%".$idproducto."%'";
        $parameters=array($this->$key
        				,JQRID_ORDER_ASC
        				,JQRID_MINROW
        				,JQRID_MAXROW
        				,$where
        				,$idempresa);
		$sql = 'CALL sp_get_listaproveedorall(?,?,?,?,?,?)';
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


	function registra (ProveedorModel $data)
	{
		$parameters=array(
						 $data->opcion
						,$data->idproveedor
						,$data->idempresa						
						,$data->tipodocumento
						,$data->nrodocumento
						,$data->razonsocial
						,$data->direccion
						,$data->ubigeo
						,$data->telefono
						,$data->celular
						,$data->email
						,$data->usuario
						);
		$sql = 'CALL sp_set_registraproveedores(?,?,?,?,?,?,?,?,?,?,?,?)';
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