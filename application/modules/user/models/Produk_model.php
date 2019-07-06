<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_model extends CI_Model
{

	public function semuaProduk() //ambil semua Produk
	{
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->order_by('id_produk', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}

	public function saveProduk($data){
        $this->db->insert("tb_produk",$data);
        return true;
	}
	
	public function updateProduk($data,$id_produk){
		$this->db->where("id_produk",$id_produk);
		$this->db->update("tb_produk",$data);
		return true;
	}
	
	public function semuaProdukDiatasStok() //ambil semua Produk Dengan Stok Tidak Kosong
	{
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->where('stok_produk >',0);
		$q = $this->db->get();
		return $q->result();
	}

	public function deleteProduk($id_produk){
		$this->db->query("delete from tb_produk where id_produk = $id_produk");
	}

	private function updateStok($id_produk,$jumlah){
		$stok = $this->db->query("select stok_produk from tb_produk where id_produk = $id_produk")->row();
		if($jumlah>$stok->stok_produk){
			return false;
		}else{
			$stokbaru = (int)$stok->stok_produk - (int)$jumlah;
			$this->db->query("update tb_produk set stok_produk = $stokbaru where id_produk = $id_produk");
			return true;
		}
	}

	private function updateSaldo($id_user,$total_harga){
		$saldo = $this->db->query("select saldo_user from tb_user where id_user = $id_user")->row();
		if($total_harga>$saldo->saldo_user){
			return false;
		}else{
			$saldoBaru = (int)$saldo->saldo_user - (int)$total_harga;
			$this->db->query("update tb_user set saldo_user = $saldoBaru where id_user = $id_user");
			return true;
		}
	}

	public function getAllTransaksi(){
        $this->db->select("*");
        $this->db->from("tb_transaksi as t");
        $this->db->join("tb_user as u","t.id_user = u.id_user");
        $this->db->join("tb_produk as p","t.id_produk = p.id_produk");
        return $this->db->get()->result();
    }
	
	public function checkOut($data){
		$cekStok = $this->updateStok($data["id_produk"],$data["jumlah_transaksi"]);
		$cekSaldo = $this->updateSaldo($data["id_user"],$data["total_harga"]);
		if($cekSaldo && $cekStok){
			$this->db->insert("tb_transaksi",$data);
			return true;
		}else{
			return false;
		}
	}

}