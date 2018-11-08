<?php
Class UnidadmedidaModel extends CI_Model
{

	private $key='idunidadmedida';
	private $table = 'unidadmedida';

	function Listar($sidx,$sord,$attr,$idempresa)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"],$idempresa);
		$sql = 'CALL sp_get_listaunidadmedidaall(?,?,?,?,?,?)';
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
		$sql = 'CALL sp_get_listaunidadmedidaall(?,?,?,?,?,?)';
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