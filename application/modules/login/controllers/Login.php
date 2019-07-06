<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->Model('login_model');
		
	}

	public function index()
	{
		$status = $this->session->userdata("login");
		$level = $status["level"];
		if($status){
			if($level=="user")
			{
				redirect("user","refresh");
			}else if($level=="admin"){
				redirect("admin","refresh");
			}
				
		}
		$this->load->view('login');
	}

	public function login_aksi(){
		$username = $this->input->post('username');
		$dataLogin = array(
				"username" => $this->input->post('username'),
				"password" => $this->input->post('password')
				);
		$this->form_validation->set_data($dataLogin);
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required|callback_cekDB');
			if ($this->form_validation->run() == FALSE) {
				echo "danger"; //Response Error
			} else {
				if($username=="admin"){
					$level = "admin";
				}else{
					$level = "user";
				}
				$sess_arr = array(
				'logged_id' => true,
				'username' => $username,
				'level' => $level
				);
				$this->session->set_userdata('login',$sess_arr);
				echo "success"; // Response Sukses
			}
	}

	public function cekDB($password) //Callback untuk cek database
	{
		$username = $this->input->post('username');
		if($username=="admin" && $password === "admin"){
			return true;
		}else{
			$hasil = $this->login_model->cekLogin($username,$password);
			if($hasil){
				return true;
			}else{
				return false;
			}
		}
	}

	public function log_out(){
		$this->session->unset_userdata('login');
		redirect("login/","refresh");
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */