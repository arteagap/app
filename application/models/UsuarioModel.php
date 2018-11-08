<?php
Class UsuarioModel extends CI_Model
{
	function getcredenciales($ruc, $login, $password)
	{
		$sql = 'CALL sp_get_validacredenciales(?,?,?)';
		$parameters = array($ruc,$login,$password);
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

	function getusuariomenu($idempresa, $login)
	{
		$sql = 'CALL sp_get_listamenuopcionusuario(?,?)';
		$parameters = array($idempresa,$login);
		$q = $this->db->query($sql, $parameters);
		if($q -> num_rows() >= 1)
		{
             mysqli_next_result($this->db->conn_id);
             $data = $q->result_array();
             $q->free_result();
             return $data;
		}
		else
		{
			return false;
		}
	}

}