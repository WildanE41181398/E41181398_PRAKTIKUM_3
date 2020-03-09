<?php 
//Model m_data dibuat untuk melayani segala query terkait CRUD database
class M_data extends CI_Model{
	function tampil_data(){
		//Function ini berfungsi untuk mengambil data dari database
		//Nama tabel yang diambil datanya dituliskan pada parameter seperti di bawah
		//Data yang diambil dari database ini dikembalikan ke pemanggil fungsi ini nantinya dengan return
		return $this->db->get('user');
    }
    
    function input_data($data,$table){
		//Method input_data berfungsi untuk menginput atau insert data
		$this->db->insert($table,$data);
    }

    function edit_data($where,$table){
		//Method edit_data berfungsi untuk mengedit data dari database		
		return $this->db->get_where($table,$where);
	}
 
	function update_data($where,$data,$table){
		//Method update_data berfungsi untuk menghadle update data
		//Syntax $this->db digunakan untuk menangkap data
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
    
    function hapus_data($where,$table){
		//Method hapus_data berfungsi untuk menghapus data
		//Terdapat fungsi where yang berguna untuk menyeleksi query dan delete untuk menghapus record
        $this->db->where($where);
        $this->db->delete($table);
    }
}