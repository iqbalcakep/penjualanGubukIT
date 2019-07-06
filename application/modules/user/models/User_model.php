<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function getDetailUser($username) //ambil user berdasarkan sesi username
	{
		$this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username_user',$username);
		$q = $this->db->get();
		return $q->result();
	}

	public function semuaUser(){
		$this->db->select('*');
        $this->db->from('tb_user');
		$q = $this->db->get();
		return $q->result();
	}
	private function updateDeposit($id_user,$tambahan){
		$saldo = $this->db->query("select saldo_user from tb_user where id_user = $id_user")->row();
		$add = (int) $saldo->saldo_user + (int) $tambahan;
		$q = $this->db->query("update tb_user set saldo_user = $add where id_user = $id_user");
		if($q){
			return true;
		}else{
			return false;
		}
	}

	public function addDeposit($data){
		$check = $this->updateDeposit($data["id_user"],$data["jumlah_deposit"]);
		if($check){
			$this->db->insert("tb_deposit",$data);
			return true;
		}else{
			return false;
		}
	}


	public function deleteuser($id_user){
		$this->db->query("delete from tb_user where id_user = $id_user");
	}

	public function saveuser($data){
		$check = $this->checkUser($data["username_user"]);
		if($check){
			$this->db->insert("tb_user",$data);
        	return true;
		}else{
			return false;
		}
		
	}

	public function updateuser($data,$id_user){
			$this->db->where("id_user",$id_user);
			$this->db->update("tb_user",$data);
        	return true;		
	}

	private function checkUser($username){
		$this->db->select('*');
        $this->db->from('tb_user');
		$this->db->where('username_user',$username);
		$result = $this->db->get();
		if($result->num_rows()>0 || $username=="admin"){
			return false;
		}else{
			return true;
		}
	}


}