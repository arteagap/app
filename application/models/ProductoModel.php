<?php
Class ProductoModel extends CI_Model
{

	private $key='IdProducto';
	private $table = 'productos';

	public $opcion; //Nuevo / Editar / Eliminar
	public $idproducto;
	public $idempresa;
	public $descripcion;
	public $codigotipo;
	public $idcategoria;
	public $rutaimagen;
	public $codigoreferencial;
	public $idunidadmedida;

	public $usuario;

	function Listar($sidx,$sord,$attr,$idempresa)
	{
        $parameters=array($sidx,$sord,$attr["start"],$attr["limit"],$attr["filter"],$idempresa);
		$sql = 'CALL sp_get_listaproductosall(?,?,?,?,?,?)';
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
		$sql = 'CALL sp_get_listaproductosall(?,?,?,?,?,?)';
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


	function registra (ProductoModel $data)
	{
		$parameters=array($data->opcion
						 ,$data->idproducto
						 ,$data->idempresa
						 ,$data->descripcion
						 ,$data->codigotipo
						 ,$data->idcategoria
						 ,$data->rutaimagen
						 ,$data->codigoreferencial
						 ,$data->idunidadmedida
						 ,$data->usuario
						);
		$sql = 'CALL sp_set_registraproductos(?,?,?,?,?,?,?,?,?,?)';
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