<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

	public function cekLogin($username,$password) //cek login tanpa security bypass
	{
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('username_user', $username);
		$this->db->where('password_user', MD5($password));
		$q = $this->db->get();
		if($q->num_rows()==1){
			return true;
		}else{
			return false;
		}
    }

}