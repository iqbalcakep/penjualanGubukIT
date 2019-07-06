<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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

    
    public function checkOut(){
        $jumlah_beli = $this->input->post("jumlah_beli");
        $id_produk = $this->input->post('id_produk');
        $total_harga = $this->input->post('totalHarga');
        $id_user = $this->sesi["user"][0]->id_user;
        $data = array(
            "id_user" => $id_user,
            "id_produk" => $id_produk,
            "total_harga" => $total_harga,
            "jumlah_transaksi" => $jumlah_beli,
            "tanggal_transaksi" => date("Y-m-d")
        );
        $insert = $this->produk_model->checkOut($data);
        if($insert){
            echo json_encode("success");
        }else{
            echo json_encode("danger");
        }
    }

}