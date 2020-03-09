<?php 
/*class Login sebagai controller yang berfungsi untuk menghandle tentang Login, 
mulai dari cek ketersediaan akun, session, logout dll
*/
class Login extends CI_Controller{

	function __construct(){
		parent::__construct();	
		//Syntax di bawah digunakan untuk memuat model m_login	
		$this->load->model('m_login');

	}

	function index(){
		//Method index() berfungsi untuk memuat atau menampilkan view v_login
		$this->load->view('v_login');
	}

	function aksi_login(){
		//Method aksi_login() ini berfungsi untuk menghandle aksi login
		//Syntax dibawah berfungsi untuk menangkap data dari form
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		//Menyimpan data pada array untuk nantinya diproses ke dalam model
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
			//menjalankan method cek_login pada model m_login
		$cek = $this->m_login->cek_login("admin",$where)->num_rows();
		//jika ditemukan data pada database sesuai apa yang diinpuutkan maka akan ke sintaks true, jika salah ke sintaks else
		if($cek > 0){
			//membuat session dengan index 'nama' yang berisi username dan 'status' berisi login
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
			//menambahkan sebuah session userdata berisi array diatas
			$this->session->set_userdata($data_session);

			redirect(base_url("admin"));
			//Mengalihkan ke url admin

		}else{
			//Apabila input salah maka akan tampil seperti di bawah
			echo "Username dan password salah !";
		}
	}

	function logout(){
		//Method logout()
		//Menghapus session yang telah ada
		$this->session->sess_destroy();
		redirect(base_url('login'));
		//Mengalihkan ke controller login

	}
}