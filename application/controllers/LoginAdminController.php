<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAdminController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginAdminModel', 'mmain');
	}

	public function index()
	{
		$config = array(
			array(
				'field'  => 'username',
				'label'  => 'Username',
				'rules'  => 'required|min_length[4]|max_length[50]|trim',
				'errors' => array(
					'required'   => '{field} wajib diisi',
					'min_length' => '{field} minimal {param} karakter',
					'max_length' => '{field} maksimal {param} karakter',
				)
			),
			array(
				'field'  => 'password',
				'label'  => 'Password',
				'rules'  => 'required|min_length[4]|max_length[50]|trim',
				'errors' => array(
					'required'   => '{field} wajib diisi',
					'min_length' => '{field} minimal {param} karakter',
					'max_length' => '{field} maksimal {param} karakter',
				)
			),
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE){
			$this->load->view('login_admin');
		}else{
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);

			if($this->_username_check($username) == FALSE){
				redirect('login/admin','refresh');
			}elseif($this->_password_check($username, $password) == FALSE){
				redirect('login/admin','refresh');
			}else{
				$arr  = $this->mmain->get_user_info($username);

				$data_session = [
					UNQ.'id'                => $arr->row()->id,
					UNQ.'nama'              => $arr->row()->nama,
					UNQ.'id_jabatan'        => $arr->row()->id_jabatan,
					UNQ.'nama_jabatan'      => $arr->row()->nama_jabatan,
					UNQ.'user_login'        => $arr->row()->user_login,
					UNQ.'foto'              => $arr->row()->foto,
					UNQ.'flag_ketua_sidang' => $arr->row()->flag_ketua_sidang,
				];
				
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('first_login', 'Login Berhasil');
				redirect('admin/rat','refresh');
			}
		}
	}

	public function logout()
	{
		$data = [
			UNQ.'id',
			UNQ.'nama',
			UNQ.'id_jabatan',
			UNQ.'nama_jabatan',
			UNQ.'user_login',
			UNQ.'foto',
			UNQ.'flag_ketua_sidang',
		];

		$this->session->unset_userdata($data);
		$this->session->set_flashdata('logout', 'Logout Berhasil');
		redirect('login/admin','refresh');
	}

	public function _username_check($username)
	{
		$username = $this->_clean_variable($username);
		$count    = $this->mcore->count('anggota', ['user_login' => $username]);

		if($count == 1){
			return TRUE;
		}else{
			$this->session->set_flashdata('username', $username);
			$this->session->set_flashdata('username_error', 'Username tidak ditemukan');
			return FALSE;
		}
	}

	public function _password_check($username, $password)
	{
		$username    = $this->_clean_variable($username);
		$password    = $this->_clean_variable($password).UYAH;
		$password_db = $this->mcore->get('anggota', 'password_login', ['user_login' => $username], NULL, 'ASC', NULL, NULL);

		if(password_verify($password, $password_db->row()->password_login)){
			return TRUE;
		}else{
			$this->session->set_flashdata('password_error', 'Password salah');
			return FALSE;
		}
	}

	public function _clean_variable($str)
	{
		return strip_tags(trim($str));
	}

	// DEVELOPMENT PURPOSE ONLY
	public function init()
	{
		$this->mcore->truncate('anggota');
		$this->mcore->truncate('anggota_polling');
		$this->mcore->truncate('anggota_polling_pengurus');
		$this->mcore->truncate('file_rat');
		$this->mcore->truncate('polling');
		$this->mcore->truncate('polling_pengurus');
		$this->mcore->truncate('rat');
		$this->mcore->truncate('respon_rat');
		$password = password_hash('admin123)'.UYAH, PASSWORD_DEFAULT);

		$data[] = [
			'nama'              => 'Master Admin',
			'tempat_lahir'      => 'Bogor',
			'tanggal_lahir'     => '2020-03-17',
			'jenis_kelamin'     => 'laki - laki',
			'no_ktp'            => NULL,
			'alamat'            => NULL,
			'no_telp'           => NULL,
			'foto'              => 'default.png',
			'id_jabatan'        => '0',
			'user_login'        => 'admin',
			'password_login'    => $password,
			'flag_ketua_sidang' => 'tidak',
		];

		$data[] = [
			'nama'              => 'Ex Ketua Pengurus',
			'tempat_lahir'      => 'Bogor',
			'tanggal_lahir'     => '2020-03-17',
			'jenis_kelamin'     => 'laki - laki',
			'no_ktp'            => '123456',
			'alamat'            => 'test alamat',
			'no_telp'           => '123456',
			'foto'              => 'default.png',
			'id_jabatan'        => '1',
			'user_login'        => 'ex_ketua_pengurus',
			'password_login'    => $password,
			'flag_ketua_sidang' => 'ya',
		];

		$data[] = [
			'nama'              => 'Ex Sekertaris',
			'tempat_lahir'      => 'Bogor',
			'tanggal_lahir'     => '2020-03-17',
			'jenis_kelamin'     => 'laki - laki',
			'no_ktp'            => '123456',
			'alamat'            => 'test alamat',
			'no_telp'           => '123456',
			'foto'              => 'default.png',
			'id_jabatan'        => '2',
			'user_login'        => 'ex_sekertaris',
			'password_login'    => $password,
			'flag_ketua_sidang' => 'tidak',
		];

		$data[] = [
			'nama'              => 'Ex Bendahara',
			'tempat_lahir'      => 'Bogor',
			'tanggal_lahir'     => '2020-03-17',
			'jenis_kelamin'     => 'laki - laki',
			'no_ktp'            => '123456',
			'alamat'            => 'test alamat',
			'no_telp'           => '123456',
			'foto'              => 'default.png',
			'id_jabatan'        => '3',
			'user_login'        => 'ex_bendahara',
			'password_login'    => $password,
			'flag_ketua_sidang' => 'tidak',
		];

		for ($i=1; $i <= 10; $i++) { 
			$data[] = [
				'nama'              => 'Anggota'.$i,
				'tempat_lahir'      => 'Bogor',
				'tanggal_lahir'     => '2020-03-17',
				'jenis_kelamin'     => 'laki - laki',
				'no_ktp'            => '1234567890',
				'alamat'            => 'Test Alamat',
				'no_telp'           => '08123456789',
				'foto'              => 'default.png',
				'id_jabatan'        => '9',
				'user_login'        => 'anggota'.$i,
				'password_login'    => $password,
				'flag_ketua_sidang' => 'tidak',
			];
		}

		for ($y=1; $y <= 10; $y++) { 
			$data[] = [
				'nama'              => 'Karyawan'.$y,
				'tempat_lahir'      => 'Bogor',
				'tanggal_lahir'     => '2020-03-17',
				'jenis_kelamin'     => 'laki - laki',
				'no_ktp'            => '1234567890',
				'alamat'            => 'Test Alamat',
				'no_telp'           => '08123456789',
				'foto'              => 'default.png',
				'id_jabatan'        => '9',
				'user_login'        => 'karyawan'.$y,
				'password_login'    => $password,
				'flag_ketua_sidang' => 'tidak',
			];
		}

		// print_r($data);
		// exit;

		$exec = $this->mcore->store_batch('anggota', $data);

		if($exec){
			echo "Init Complete";
		}else{
			echo "Init Fail";
		}
	}
	// END DEVELOPMENT PURPOSE ONLY

}

/* End of file LoginAdminController.php */
/* Location: ./application/controllers/LoginAdminController.php */