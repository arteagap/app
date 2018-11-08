<?php
Class TablasModel extends CI_Model
{
	function getdata($codigotabla)
	{
        $parameters=array($codigotabla);
		$sql = 'CALL sp_get_listatablas(?)';
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

	function gettipoafectacion($idempresa){
		$sql = "select * 
		FROM tipoafectacion t
		where t.flgeli='0'
		and   t.idempresa=".$idempresa.";";
		$q = $this->db->query($sql);
		if($q -> num_rows() >= 1)
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

	function gettipooperacion($idempresa){
		$sql = "select * 
		FROM tipooperacion t
		where t.flgeli='0'
		and   t.idempresa=".$idempresa.";";
		$q = $this->db->query($sql);
		if($q -> num_rows() >= 1)
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
}