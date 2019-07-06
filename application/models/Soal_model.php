<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal_model extends CI_Model
{

	public function listtipe(){
		return $this->db->query("select * from tipe_soal")->result();
	}

	public function listcerita(){
		return $this->db->query("select * from cerita")->result();
	}
	public function save($data){
		$this->db->insert("soal",$data);
	}

	public function save_cerita($data){
		$this->db->insert("cerita",$data);
	}

	public function getCerita($id){
		return $this->db->query("select * from cerita where id_cerita = '$id'")->result();
	}
}