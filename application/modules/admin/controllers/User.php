<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    protected $sesi = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('transaksi_model','user/user_model'));
		$status = $this->session->userdata("login");
		$level = $status["level"];
		if($status){
			$this->sesi = $status["username"];
			if($level=="user")
			{
				redirect("user","refresh");
			}
				
		}else{
			redirect("login","refresh");
		}

    }
    
    public function saveuser(){
        $data = array(
			"nama_user" => $this->input->post('nama_user'),
			"username_user" => $this->input->post('username_user'),
			"password_user" => MD5($this->input->post('password_user')),
			"saldo_user" => $this->input->post('saldo_user'),
        );
        $insert = $this->user_model->saveuser($data);
        if($insert){
            $response = array(
                "status" => "success"
                );
        }else{
            $response = array(
                "status" => "danger"
                );
        }
      
        echo json_encode($response);
	}
	
	public function updateuser(){
        if($this->input->post('password_user')==""){ 
			$data = array(
                "nama_user" => $this->input->post('nama_user'),
                "username_user" => $this->input->post('username_user'),
            );
		}else{
			$data = array(
                "nama_user" => $this->input->post('nama_user'),
                "username_user" => $this->input->post('username_user'),
                "password_user" => MD5($this->input->post('password_user')),
            );
		}
		$insert = $this->user_model->updateuser($data,$this->input->post('id_user'));
        if($insert){
            $response = array(
                "status" => "success"
                );
        }else{
            $response = array(
                "status" => "danger"
                );
        }
        echo json_encode($response);
	}

	public function deleteuser(){
		$this->user_model->deleteuser($this->input->post('id_user'));
		$response = array(
			"status" => "success"
			);
		echo json_encode($response);
		
	}
	

    private function semuauser(){
		return $this->user_model->semuauser();
	}

}

/* End of file Controllername.php */
