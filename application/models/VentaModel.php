<?php
Class VentaModel extends CI_Model
{

	private $key='idmovimiento';
	private $table = 'movimiento';


	public $idmovimiento;
	public $IdEmpresa;
	public $idsucursal;
	public $codigotipotransaccion;
	public $flgtipomovimiento;
	public $idcomprobantes;
	public $idalmacenorigen;
	public $idalmacendestino;
	public $idmoneda;
	public $idcliente;
	public $idseries;
	public $nrocomprobante;
	public $fechaemision;
	public $fechavencimiento;
	public $codtipooperacion;
	public $flgigv;
	public $valorigv;
	public $gravadas;
	public $dctoglobal;
	public $exonerada;
	public $inafectas;
	public $gratuitas;
	public $otroscargos;
	public $total;
	public $caddetalle;

	public $usuario;

	function Listar($sidx,$sord,$attr,$idempresa)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"],$idempresa);
		$sql = 'CALL sp_get_listaventasall(?,?,?,?,?,?)';
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

	function registra (VentaModel $data)
	{
		$parameters=array(
						   $data->idmovimiento
						  ,$data->IdEmpresa
						  ,$data->idsucursal
						  ,$data->codigotipotransaccion
						  ,$data->flgtipomovimiento
						  ,$data->idcomprobantes
						  ,$data->idmoneda
						  ,$data->idcliente
						  ,$data->idseries
						  ,$data->nrocomprobante
						  ,$data->fechaemision
						  ,$data->fechavencimiento
						  ,$data->codtipooperacion
						  ,$data->flgigv
						  ,$data->valorigv
						  ,$data->gravadas
						  ,$data->dctoglobal
						  ,$data->exonerada
						  ,$data->inafectas
						  ,$data->gratuitas
						  ,$data->otroscargos
						  ,$data->total
						  ,$data->caddetalle
						  ,$data->usuario
						);
		$sql = 'CALL sp_set_generaventabolfact(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
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

	function getcabeceraventacpe($idmovimiento)
	{
		$parameters=array($idmovimiento);
		$sql = 'CALL sp_get_ventaenviosunat(?)';
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

	function getdetalleventacpe($idmovimiento)
	{
		$parameters=array($idmovimiento);
		$sql = 'CALL sp_get_ventaenviosunatdetalle(?)';
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