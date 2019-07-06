<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    protected $sesi = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('transaksi_model','user/produk_model'));
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
    
    public function saveProduk(){
        $config['upload_path']="./assets/file";
        $config['allowed_types']='gif|jpg|png'; 
        $this->load->library('upload',$config); 
        if($this->upload->do_upload("gambar_produk")){ 
            $foto = array('upload_data' => $this->upload->data());
            $gambar_produk= $foto['upload_data']['file_name']; 
		}else{
			$gambar_produk =null;
        }
        $data = array(
			"nama_produk" => $this->input->post('nama_produk'),
			"harga_produk" => $this->input->post('harga_produk'),
			"stok_produk" => $this->input->post('stok_produk'),
			"deskripsi_produk" => $this->input->post('deskripsi_produk'),
			"gambar_produk" => $gambar_produk,
        );
        $this->produk_model->saveProduk($data);
        $response = array(
        "status" => "success", 
        "data" => $this->semuaProduk()
        );
        echo json_encode($response);
	}
	
	public function updateProduk(){
		$config['upload_path']="./assets/file";
        $config['allowed_types']='gif|jpg|png'; 
        $this->load->library('upload',$config); 
        if($this->upload->do_upload("gambar_produk")){ 
            $foto = array('upload_data' => $this->upload->data());
			$gambar_produk= $foto['upload_data']['file_name']; 
			$data = array(
				"nama_produk" => $this->input->post('nama_produk'),
				"harga_produk" => $this->input->post('harga_produk'),
				"stok_produk" => $this->input->post('stok_produk'),
				"deskripsi_produk" => $this->input->post('deskripsi_produk'),
				"gambar_produk" => $gambar_produk,
			);
		}else{
			$data = array(
				"nama_produk" => $this->input->post('nama_produk'),
				"harga_produk" => $this->input->post('harga_produk'),
				"stok_produk" => $this->input->post('stok_produk'),
				"deskripsi_produk" => $this->input->post('deskripsi_produk'),
			);
		}
		$this->produk_model->updateProduk($data,$this->input->post('id_produk'));
		$response = array(
			"status" => "success"
			);
		echo json_encode($response);
		
	}

	public function deleteProduk(){
		$this->produk_model->deleteProduk($this->input->post('id_produk'));
		$response = array(
			"status" => "success"
			);
		echo json_encode($response);
		
	}
	

    private function semuaProduk(){
		return $this->produk_model->semuaProduk();
	}

}

/* End of file Controllername.php */
