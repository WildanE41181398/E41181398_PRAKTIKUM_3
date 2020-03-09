<?php 

//Membuat class Crud sesuai dengan nama controller dan diawali huruf besar
//Meng-extends class Crud CI_Controller
class Crud extends CI_Controller{

	function __construct(){
	/*function construct untuk menjalankan fungsi yang diinginkan pada saat controller diakses.
	biasanya diletakkan fungsi untuk memanggil helper atau library yang diaktifkannya di autoload.php
	*/
		parent::__construct();
		//Memanggil model m_data karena operasi database dibuat pada model m_data		
		$this->load->model('m_data');
		//Memanggil helper url
		$this->load->helper('url');

	}

	function index(){
		/*Pada method index ini menampilkan data dengan function tampil_data yang telah dibuat 
		pada model m_data untuk mengambil data dari database
		*/
		$data['user'] = $this->m_data->tampil_data()->result();
		//Memparsing data ke view v_tampil
		/*Pada view v_tampil terdapat function anchor() yang berfungsi untuk membuat hyperlink
		pada parameter pertama diletakkan link tujuan, dan pada parameter kedua diletakkan text
		yang akan dimunculkan 
		*/
		$this->load->view('v_tampil',$data);
	}




	//Cara menginput data ke database
	
	function tambah(){
		//Method tambah ini berfungsi untuk menampilkan view v_input
		//v_input digunakan untuk tampilan form inputan, di mana data yang diinput akan masuk ke database
		//Pada form ditentukan aksi dari form yang diarahkan ke method tambah_aksi pada controller crud
		$this->load->view('v_input');
	}

	function tambah_aksi(){
		//Method tambah_aksi terdapat syntax $this->input->post yang berfungsi menangkap inputan dari form
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$pekerjaan = $this->input->post('pekerjaan');
		//Menjadikan array 
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'pekerjaan' => $pekerjaan
			);
		$this->m_data->input_data($data,'user');
		//Menginput data ke database dengan menggunakan model m_data
		//Pada parameter pertama diinputkan array data yang berisi data-data yang diinput
		//Pada parameter kedua diberi nama tabel nya(tabel tempat tujuan tempat menyimpan data inputan)
		redirect('crud/index');
		//Mengalihkan ke method index pada controller crud
	}
	



	//Method hapus   
    function hapus($id){
		/*Pada view v_tampil sudah terdapat link edit dan hapus yang dibuat dengan function anchor()
		yang telah tertuju pada method ini dan berisi juga pengiriman data id pada segment 3 nya
		*/
		//Terdapat variabel $id berguna untuk menangkap data id yang dikirim melalui url dari link hapus
		$where = array('id' => $id);
		//Menjadikan array untuk dikirimkan data array nya ke model m_data
		$this->m_data->hapus_data($where,'user');
		//Memanggil method hapus_data pada model m_data
		//Dimasukkan variabel $where yang berisi data id tadi
		//Pada parameter kedua dimasukkan nama tabel
		redirect('crud/index');
		//Mengalihkan ke method index pada controller crud
    }
	
	
	//Method untuk update data
    function edit($id){
		/*Menjadikan id menjadi array yang kemudian kita gunakan untuk mengambil data menurut id
		dengan menggunakan function edit_data() pada model m_data 
		*/ 
        $where = array('id' => $id);
		$data['user'] = $this->m_data->edit_data($where,'user')->result();
		/*Fungsi result() berguna untuk meng-generate hasil query menjadi array dan
		kemudian ditampilkan pada view v_tampil
		*/
		//Membuat view v_edit di mana view ini dijadikan sebagai form yang menampilkan data yang akan diedit
		$this->load->view('v_edit',$data);
		//Menampilkan view v_edit dan parsing dari variabel $data
    }


	/*Method update untuk membuat aksi yang menghandle update data sesuai dengan
	action form edit yang diarahkan pada method update() ini
	*/
    function update(){
		//Syntax $this->input->post berfungsi untuk menangkap data dari form edit
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');
		//Kemudian masukkan data yang akan diupdate ke dalam variabel data yang dijadikan array
        $data = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );
		//Variabel where yang menjadi penentu data yang diupdate (id yang mana)
        $where = array(
            'id' => $id
		);
		
		//Memanggil method update_data() pada model m_data untuk menghandle update data
		$this->m_data->update_data($where,$data,'user');

		//Mengalihkan ke method index
        redirect('crud/index');
    }

}