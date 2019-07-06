<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	protected $sesi = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('transaksi_model','user/produk_model','user/user_model'));
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

	public function index()
	{
		$data["transaksi"] = $this->riwayatTransaksi();
		$data["nama"] = $this->sesi;
		$this->load->view('index',$data);
	}

	public function showProduk(){
		$data["produk"] = $this->semuaProduk();
		$data["nama"] = $this->sesi;
		$this->load->view('produk',$data);
	}

	public function showUser(){
		$data["user"] = $this->semuaUser();
		$data["nama"] = $this->sesi;
		$this->load->view('user',$data);
	}

	private function riwayatTransaksi(){
		return $this->transaksi_model->getAllTransaksi();
	}

	private function semuaProduk(){
		return $this->produk_model->semuaProduk();
	}

	private function semuaUser(){
		return $this->user_model->semuaUser();
	}


}
