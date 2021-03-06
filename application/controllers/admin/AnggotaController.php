<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
		$this->load->model('AnggotaAdminModel', 'mmain');
	}

	public function index()
	{
		$data['title']   = 'Data Anggota';
		$data['content'] = 'anggota/index';
		$data['vitamin'] = 'anggota/vitamin';
		$data['arr']     = $this->mmain->get_list_anggota();

		$this->template->template($data);
	}

	public function create()
	{
		$data['title']       = 'Tambah Anggota';
		$data['content']     = 'anggota/form';
		$data['vitamin']     = 'anggota/form_vitamin';
		$data['arr_jabatan'] = $this->mcore->get('list_kode', '*', ['group_list' => 'jabatan'], 'id_list', 'ASC', NULL, NULL);
		
		$this->template->template($data);
	}

	public function store()
	{
		$pesan_duplikat    = '<mark>User Login</mark> telah terdaftar!<br>Silahkan gunakan User Login lainnya';
		$foto              = 'default.png';
		$tgl_lhr_obj       = new DateTime();
		$nama              = $this->input->post('nama', TRUE);
		$tempat_lahir      = $this->input->post('tempat_lahir', TRUE);
		$tanggal_lahir     = $tgl_lhr_obj->createFromFormat('d-m-Y', $this->input->post('tanggal_lahir', TRUE))->format('Y-m-d');
		$jenis_kelamin     = $this->input->post('jenis_kelamin', TRUE);
		$no_ktp            = $this->input->post('no_ktp', TRUE);
		$alamat            = $this->input->post('alamat', TRUE);
		$no_telp           = $this->input->post('no_telp', TRUE);
		$id_jabatan        = $this->input->post('id_jabatan', TRUE);
		$user_login        = $this->input->post('user_login', TRUE);
		$password_login    = password_hash($this->input->post('password_login', TRUE).UYAH, PASSWORD_DEFAULT);
		$flag_ketua_sidang = 'tidak';

		# cek duplikat
		$count = $this->mcore->count('anggota', ['user_login' => $user_login]);
		if($count > 0){
			$this->session->set_flashdata('success', $pesan_duplikat);
			$this->session->set_flashdata('nama_temp', $nama);
			$this->session->set_flashdata('tempat_lahir_temp', $tempat_lahir);
			$this->session->set_flashdata('tanggal_lahir_temp', $tanggal_lahir);
			$this->session->set_flashdata('jenis_kelamin_temp', $jenis_kelamin);
			$this->session->set_flashdata('no_ktp_temp', $no_ktp);
			$this->session->set_flashdata('alamat_temp', $alamat);
			$this->session->set_flashdata('no_telp_temp', $no_telp);
			$this->session->set_flashdata('id_jabatan_temp', $id_jabatan);
			$this->session->set_flashdata('user_login_temp', $user_login);
			redirect(site_url('admin/anggota/create'), 'refresh');
			exit;
		}
		# end cek duplikat
		
		# cek foto ada apa engga
		$config['upload_path']   = './assets/img/foto/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 10024; // 10 MB
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('foto')){
			$data_upload = $this->upload->data();
			$foto = $data_upload['file_name'];
		}
		# end cek foto ada apa engga

		$data = compact('nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_ktp', 'alamat', 'no_telp', 'id_jabatan', 'user_login', 'password_login', 'foto', 'flag_ketua_sidang');
		$exec = $this->mcore->store('anggota', $data);

		if($exec){
			$this->session->set_flashdata('success', 'Tambah Data Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Tambah Data Gagal');
		}

		redirect(site_url('admin/anggota/create'), 'refresh');
	}

	public function edit($id)
	{
		$data['title']       = 'Edit Anggota';
		$data['content']     = 'anggota/form_edit';
		$data['vitamin']     = 'anggota/form_edit_vitamin';
		$data['arr']         = $this->mcore->get('anggota', '*', ['id' => $id], NULL, 'ASC', NULL, NULL);
		$data['arr_jabatan'] = $this->mcore->get('list_kode', '*', ['group_list' => 'jabatan'], 'id_list', 'ASC', NULL, NULL);
		$data['tgl_lhr_obj'] = new DateTime();
		
		$this->template->template($data);
	}

	public function update()
	{
		$tgl_lhr_obj   = new DateTime();
		$id            = $this->input->post('id', TRUE);
		$prev_foto     = $this->input->post('prev_foto', TRUE);
		$foto          = $prev_foto;
		$nama          = $this->input->post('nama', TRUE);
		$tempat_lahir  = $this->input->post('tempat_lahir', TRUE);
		$tanggal_lahir = $tgl_lhr_obj->createFromFormat('d-m-Y', $this->input->post('tanggal_lahir', TRUE))->format('Y-m-d');
		$jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
		$no_ktp        = $this->input->post('no_ktp', TRUE);
		$alamat        = $this->input->post('alamat', TRUE);
		$no_telp       = $this->input->post('no_telp', TRUE);
		$id_jabatan    = $this->input->post('id_jabatan', TRUE);
		
		# cek foto ada apa engga
		$config['upload_path']   = './assets/img/foto/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 10024; // 10 MB
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('foto')){
			$data_upload = $this->upload->data();
			$foto = $data_upload['file_name'];
		}
		# end cek foto ada apa engga

		$data = compact('nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_ktp', 'alamat', 'no_telp', 'id_jabatan', 'foto');
		$exec = $this->mcore->update('anggota', $data, ['id' => $id]);

		if($exec){
			$this->session->set_flashdata('success', 'Update Data Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Update Data Gagal');
		}

		redirect(site_url('admin/anggota'), 'refresh');
	}

	public function destroy($id)
	{
		$exec = $this->mcore->delete('anggota', ['id' => $id]);

		if($exec){
			$this->session->set_flashdata('success', 'Delete Data Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Delete Data Gagal');
		}
		redirect(site_url('admin/anggota'), 'refresh');
	}

	public function reset()
	{
		$id             = $this->input->post('id_anggota_reset', TRUE);
		$reset_password = password_hash($this->input->post('reset_password', TRUE).UYAH, PASSWORD_DEFAULT);

		$data  = ['password_login' => $reset_password];
		$where = ['id' => $id];
		$exec  = $this->mcore->update('anggota', $data, $where);

		if($exec){
			$this->session->set_flashdata('success', 'Reset Password Berhasil');
			redirect(site_url('admin/anggota'), 'refresh');
		}else{
			$this->session->set_flashdata('success', 'Reset Password Gagal');
			redirect(site_url('admin/anggota'), 'refresh');
		}
	}

}

/* End of file AnggotaController.php */
/* Location: ./application/controllers/admin/AnggotaController.php */