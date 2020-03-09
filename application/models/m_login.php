<?php 
//Class M_login

class M_login extends CI_Model{	
	//Method cek_login() untuk memeriksa apakah terdapat data
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	
}