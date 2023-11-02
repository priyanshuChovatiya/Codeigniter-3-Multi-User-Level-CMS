<?php
// namespace 

defined('BASEPATH') or exit('No direct script access allowed');

require_once('system/core/Model.php');
// use CI_Model;

class Dbh extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getResultArray($table)
	{
		return $this->db->get($table)->result_array();
	}

	public function getResultArrayDesc($table)
	{
		$this->db->order_by($table . '.id', 'DESC');
		return $this->db->get($table)->result_array();
	}

	public function getRowArray($table, $id)
	{
		return $this->db->get_where($table, ['id' => $id])->row_array();
	}

	public function getWhereRowArray($table, $arr)
	{
		return $this->db->get_where($table, $arr)->row_array();
	}

	public function getWhereResultArray($table, $arr)
	{
		return $this->db->get_where($table, $arr)->result_array();
	}

	public function passwordVerify($table, $arr)
	{
		$data = $this->db->get_where($table, $arr);
		if ($data->num_rows() > 0) {
			return $data->row_array();
		} else {
			return false;
		}
	}

	public function deleteRow($table, $id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete($table)) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteAllWhere($table, $arr)
	{
		foreach ($arr as $key => $v) {
			$this->db->where($key, $v);
		}
		$delete = $this->db->delete($table);
		if (!$delete) {
			return false;
		}
		return true;
	}

	public function getLastRow($table)
	{
		$this->db->order_by('id', "DESC");
		return $this->db->get($table)->row_array();
	}

	public function findOrFail($table, $array, $type = "row")
	{
		$query = $this->db->get_where($table, $array);
		if ($query->num_rows() > 0):
			switch ($type) {
				case 'row':
					return $query->row_array();
				case 'result':
					return $query->result_array();
			}
		endif;
		return false;
	}
	public function findOrFailResultArray($table, $array)
	{
		$query = $this->db->get_where($table, $array);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	public function getLastRowWhere($table, $where, $notWhere = [])
	{
		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		foreach ($notWhere as $v) {
			$this->db->where($v);
		}
		$this->db->order_by('id', "DESC");
		return $this->db->get($table)->row_array();
	}

	public function isDataExists($table, $arr)
	{
		if ($this->db->get_where($table, $arr)->num_rows() > 0) {
			return true;
		}
		return false;
	}
}