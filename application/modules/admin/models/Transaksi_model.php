<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getAllTransaksi(){
        $this->db->select("*");
        $this->db->from("tb_transaksi as t");
        $this->db->join("tb_user as u","t.id_user = u.id_user");
        $this->db->join("tb_produk as p","t.id_produk = p.id_produk");
        return $this->db->get()->result();
    }
    

}

/* End of file Transaksi_model.php */
