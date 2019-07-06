<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	protected $sesi = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model','produk_model'));
		$status = $this->session->userdata("login");
		$level = $status["level"];
		$username = $status["username"];
		if($status){
			$hasil["user"]=$this->user_model->getDetailUser($username);
			$this->sesi = $hasil;
			if($level=="admin")
			{
				redirect("admin","refresh");
			}
				
		}else{
			redirect("login/login","refresh");
		}

	}

	public function index()
	{
		$data["produkALL"] = $this->produk_model->semuaProdukDiatasStok();
		$data["nama"] = $this->sesi["user"][0]->nama_user;
		$data["saldo"] = $this->sesi["user"][0]->saldo_user;
		$data["id_user"] = $this->sesi["user"][0]->id_user; 
		$this->load->view('index',$data);
	}

	public function deposit(){
		$data["nama"] = $this->sesi["user"][0]->nama_user;
		$data["saldo"] = $this->sesi["user"][0]->saldo_user;
		$data["id_user"] = $this->sesi["user"][0]->id_user; 
		$this->load->view('deposit',$data);
	}

	public function addDeposit(){
		$data = array(
			"id_user" => $this->input->post('id_user'),
			"pengirim_deposit" => $this->input->post('nama_pengirim'),
			"jumlah_deposit" => $this->input->post('saldo_tambah'),
			"tanggal_deposit" => date("Y-m-d")
		);
		$insert = $this->user_model->addDeposit($data);
		if($insert){
            echo json_encode("success");
        }else{
            echo json_encode("danger");
        }
	}



}
