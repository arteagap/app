<?php
Class SucursalModel extends CI_Model
{

	private $key='idsucursal';
	private $table = 'sucursal';


	public $opcion; //Nuevo / Editar / Eliminar
	public $idsucursal;
	public $idempresa;
	public $nombre;
	public $direccion;
	public $ubigeo;	
	public $codigosunat;
	public $usuario;	

	function Listar($sidx,$sord,$attr,$idempresa)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"],$idempresa);
		$sql = 'CALL sp_get_listasucursalall(?,?,?,?,?,?)';
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
		$sql = 'CALL sp_get_listasucursalall(?,?,?,?,?,?)';
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

	function sucursalacceso($usuario,$idempresa)
	{
        $parameters=array($usuario
        				,$idempresa);
		$sql = 'CALL sp_get_sucursalporusuarioempresa(?,?)';
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

function registra (SucursalModel $data)
	{
		$parameters=array(
			             $data->opcion
						,$data->idsucursal
						,$data->idempresa
						,$data->nombre
						,$data->direccion
						,$data->ubigeo
						,$data->codigosunat
						,$data->usuario
						);
		$sql = 'CALL sp_set_registrasucursal(?,?,?,?,?,?,?,?)';
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