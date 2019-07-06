<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

	public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('guru');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$q = $this->db->get();
		if($q->num_rows()==1){
			return true;
		}else{
			return false;
		}
    }
}