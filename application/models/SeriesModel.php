<?php
Class SeriesModel extends CI_Model
{

	private $key='idseries';
	private $table = 'series';

	public $opcion; //Nuevo / Editar / Eliminar
	public $idseries;
	public $idsucursal;
	public $idcomprobantes;
	public $codigoserie;
	public $correlativo;
	public $loingitudcorrelativo;
	public $usuario;

	function Listar($sidx,$sord,$attr,$idempresa)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"],$idempresa);
		$sql = 'CALL sp_get_listaseriesall(?,?,?,?,?,?)';
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
		$sql = 'CALL sp_get_listaseriesall(?,?,?,?,?,?)';
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

	function seriesxcomprobantesucursal($idempresa,$idsucursal,$idcomprobantes)
	{
        $parameters=array($idempresa
        				,$idsucursal
        				,$idcomprobantes);
		$sql = 'CALL sp_get_seriesporsucursalcomprobante(?,?,?)';
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

	function registra (SeriesModel $data)
	{
		$parameters=array(	$data->opcion
							,$data->idseries
							,$data->idsucursal
							,$data->idcomprobantes
							,$data->codigoserie
							,$data->correlativo
							,$data->loingitudcorrelativo
							,$data->usuario
						);
		$sql = 'CALL sp_set_registroseries(?,?,?,?,?,?,?,?)';
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