<?php
Class ComprobantesModel extends CI_Model
{

	private $key='idcomprobantes';
	private $table = 'comprobantes';


	public $opcion; //Nuevo / Editar / Eliminar
	public $idcomprobantes;
	public $idempresa;
	public $descripcion;
	public $codigosunat;
	public $flgcompra;
	public $flgventa;
	public $usuario;

	function Listar($sidx,$sord,$attr,$idempresa)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"],$idempresa);
		$sql = 'CALL sp_get_listacomprobantesall(?,?,?,?,?,?)';
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
		$sql = 'CALL sp_get_listacomprobantesall(?,?,?,?,?,?)';
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

	function registra (ComprobantesModel $data)
	{
		$parameters=array($data->opcion
						,$data->idcomprobantes
						,$data->idempresa
						,$data->descripcion
						,$data->codigosunat
						,$data->flgcompra
						,$data->flgventa
						,$data->usuario
						);
		$sql = 'CALL sp_set_registracomprobantes(?,?,?,?,?,?,?,?)';
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