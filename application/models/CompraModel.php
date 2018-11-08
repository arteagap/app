<?php
Class CompraModel extends CI_Model
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
	public $idproveedor;
	public $codserie;
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

	function Listar($sidx,$sord,$attr,$idempresa)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"],$idempresa);
		$sql = 'CALL sp_get_listacomprasall(?,?,?,?,?,?)';
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

	function registra (CompraModel $data)
	{
		$parameters=array(
						   $data->idmovimiento
						  ,$data->IdEmpresa
						  ,$data->idsucursal
						  ,$data->codigotipotransaccion
						  ,$data->flgtipomovimiento
						  ,$data->idcomprobantes
						  ,$data->idmoneda
						  ,$data->idproveedor
						  ,$data->codserie
						  ,$data->nrocomprobante
						  ,$data->fechaemision
						  ,$data->valorigv
						  ,$data->gravadas
						  ,$data->total
						  ,$data->caddetalle
						  ,$data->usuario
						);
		$sql = 'CALL sp_set_registracompras(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
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