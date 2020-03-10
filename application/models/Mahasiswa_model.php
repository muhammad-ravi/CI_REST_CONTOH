<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function getMahasiswa($id = null){
		if($id == null){
			return $this->db->get('mahasiswa')->result_array();
		}else{
			return $this->db->get_where('mahasiswa',array('id' => $id))->result_array();
		}
	}

	public function deleteMahasiswa($id){
		$this->db->delete('mahasiswa', array('id'=>$id));
		return $this->db->affected_rows();
	}

	public function createMahasiswa($data){
		$this->db->insert('mahasiswa', $data);
		return $this->db->affected_rows();
	}

	public function updateMahasiswa($data, $id){
		$this->db->update('mahasiswa', $data, array('id' => $id));
		return $this->db->affected_rows();
	}
}
