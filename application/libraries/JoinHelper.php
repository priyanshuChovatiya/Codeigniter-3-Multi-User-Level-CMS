<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('Dbh.php');

class Joinhelper extends Dbh
{

	function __construct()
	{
		parent::__construct();
	}

	function fetchJoinedTable($table, $join_tables)
	{
		$database = $this->db->database;
		$join_tables_columnnames = [];
		foreach ($join_tables as $jt) {
			$join_tables_columnnames[$jt] = $this->db->query("SELECT `COLUMN_NAME` AS cname
												FROM `INFORMATION_SCHEMA`.`COLUMNS` 
												WHERE `TABLE_SCHEMA`='$database' AND `TABLE_NAME`='$jt';
											")->result_array();
		}

		$selectString = "$table.*,";
		foreach ($join_tables_columnnames as $jt => $cnames) {
			foreach ($cnames as $cname) {
				$selectString .= $jt . "." . $cname['cname'] . " as " . $jt . "_" . $cname['cname'] . ",";
			}
		}
		$this->db->select($selectString);
		$this->db->from($table);
		foreach ($join_tables_columnnames as $jt => $cnames) {
			$this->db->join($jt, "$jt.id = $table.$jt" . "_id", 'left');
		}
		$data = $this->db->get()->result_array();
		return $data;
	}
	function fetchJoinedTableCustomead($table, $join_tables)
	{
		$database = $this->db->database;

		$join_tables_columnnames = [];
		foreach ($join_tables as $jt) {
			$join_tables_columnnames[$jt] = $this->db->query("SELECT `COLUMN_NAME` AS cname
												FROM `INFORMATION_SCHEMA`.`COLUMNS` 
												WHERE `TABLE_SCHEMA`='$database'
													AND `TABLE_NAME`='$jt';
											")->result_array();
		}

		$selectString = "$table.*,";

		foreach ($join_tables_columnnames as $jt => $cnames) {
			foreach ($cnames as $cname) {
				$selectString .= $jt . "." . $cname['cname'] . " as " . $jt . "_" . $cname['cname'] . ",";
			}
		}

		$this->db->select($selectString);
		$this->db->from($table);
		foreach ($join_tables_columnnames as $jt => $cnames) {
			$this->db->join($jt, "$jt.id = $table.$jt" . "_id", 'left');
		}
		$this->db->order_by('ad.priority_id', 'desc');
		$data = $this->db->get()->result_array();
		return $data;
	}
	function fetchJoinedTableDesc($table, $join_tables)
	{
		$database = $this->db->database;

		$join_tables_columnnames = [];
		foreach ($join_tables as $jt) {
			$join_tables_columnnames[$jt] = $this->db->query("SELECT `COLUMN_NAME` AS cname
												FROM `INFORMATION_SCHEMA`.`COLUMNS` 
												WHERE `TABLE_SCHEMA`='$database'
													AND `TABLE_NAME`='$jt';
											")->result_array();
		}

		$selectString = "$table.*,";

		foreach ($join_tables_columnnames as $jt => $cnames) {
			foreach ($cnames as $cname) {
				$selectString .= $jt . "." . $cname['cname'] . " as " . $jt . "_" . $cname['cname'] . ",";
			}
		}

		$this->db->select($selectString);
		$this->db->from($table);
		foreach ($join_tables_columnnames as $jt => $cnames) {
			$this->db->join($jt, "$jt.id = $table.$jt" . "_id", 'left');
		}
		$this->db->order_by($table . '.id', 'DESC');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function fetchJoinedTableWhere($table, $join_tables, $arr)
	{
		$database = $this->db->database;

		$join_tables_columnnames = [];
		foreach ($join_tables as $jt) {
			$join_tables_columnnames[$jt] = $this->db->query("SELECT `COLUMN_NAME` AS cname
												FROM `INFORMATION_SCHEMA`.`COLUMNS` 
												WHERE `TABLE_SCHEMA`='$database'
													AND `TABLE_NAME`='$jt';
											")->result_array();
		}

		$selectString = "$table.*,";

		foreach ($join_tables_columnnames as $jt => $cnames) {
			foreach ($cnames as $cname) {
				$selectString .= $jt . "." . $cname['cname'] . " as " . $jt . "_" . $cname['cname'] . ",";
			}
		}

		$this->db->select($selectString);
		$this->db->from($table);

		foreach ($arr as $col => $val) {
			$this->db->where($col, $val);
		}

		foreach ($join_tables_columnnames as $jt => $cnames) {
			$this->db->join($jt, "$jt.id = $table.$jt" . "_id", 'left');
		}
		$data = $this->db->get()->result_array();
		return $data;
	}

	function fetchJoinedTableWhereRow($table, $join_tables, $arr)
	{
		$database = $this->db->database;

		$join_tables_columnnames = [];
		foreach ($join_tables as $jt) {
			$join_tables_columnnames[$jt] = $this->db->query("SELECT `COLUMN_NAME` AS cname
												FROM `INFORMATION_SCHEMA`.`COLUMNS` 
												WHERE `TABLE_SCHEMA`='$database'
													AND `TABLE_NAME`='$jt';
											")->result_array();
		}

		$selectString = "$table.*,";

		foreach ($join_tables_columnnames as $jt => $cnames) {
			foreach ($cnames as $cname) {
				$selectString .= $jt . "." . $cname['cname'] . " as " . $jt . "_" . $cname['cname'] . ",";
			}
		}

		$this->db->select($selectString);
		$this->db->from($table);

		foreach ($arr as $col => $val) {
			$this->db->where($col, $val);
		}

		foreach ($join_tables_columnnames as $jt => $cnames) {
			$this->db->join($jt, "$jt.id = $table.$jt" . "_id", 'left');
		}
		$data = $this->db->get()->row_array();
		return $data;
	}

	function fetchJoinedTableRow($table, $join_tables, $id)
	{
		$database = $this->db->database;

		$join_tables_columnnames = [];
		foreach ($join_tables as $jt) {
			$join_tables_columnnames[$jt] = $this->db->query("SELECT `COLUMN_NAME` AS cname
												FROM `INFORMATION_SCHEMA`.`COLUMNS` 
												WHERE `TABLE_SCHEMA`='$database'
													AND `TABLE_NAME`='$jt';
											")->result_array();
		}

		$selectString = "$table.*,";

		foreach ($join_tables_columnnames as $jt => $cnames) {
			foreach ($cnames as $cname) {
				$selectString .= $jt . "." . $cname['cname'] . " as " . $jt . "_" . $cname['cname'] . ",";
			}
		}

		$this->db->select($selectString);
		$this->db->from($table);
		foreach ($join_tables_columnnames as $jt => $cnames) {
			$this->db->join($jt, "$jt.id = $table.$jt" . "_id", 'left');
		}
		$this->db->where($table . '.id', $id);
		$data = $this->db->get()->row_array();
		return $data;
	}
}