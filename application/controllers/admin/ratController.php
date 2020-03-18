<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RatController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
		$this->load->model('RATModel', 'mmain');
	}

	public function index()
	{
		$data['title']             = 'Hal List RAT';
		$data['content']           = 'rat/index';
		$data['vitamin']           = 'rat/vitamin';
		$data['arr']               = $this->mmain->rat_data();
		$data['polling_mulai_obj'] = new DateTime();
		$data['polling_akhir_obj'] = new DateTime();
		$data['rat_mulai_obj']     = new DateTime();
		$data['rat_akhir_obj']     = new DateTime();

		$this->template->template($data);
	}

	public function create()
	{
		$data['title']         = 'Regis RAT';
		$data['content']       = 'rat/form';
		$data['vitamin']       = 'rat/form_vitamin';

		$this->template->template($data);
	}

	public function penetapan($id_rat)
	{
		$max_vote = $this->mmain->pilih_nilai_max_vote($id_rat)->row()->vote;
		$arr = $this->mmain->anggota_voter_tertinggi($id_rat, $max_vote);

		if($arr->num_rows() > 1){
			redirect('admin/rat/penetapan_manual/'.$id_rat,'refresh');
			exit;
		}elseif($arr->num_rows() == 0){
			$this->session->set_flashdata('success', 'Penetapan tidak dapat dilakukan dikarenakan belum ada anggota yang memilih');
			redirect('admin/rat','refresh');
			exit;
		}else{
			$id_ketua_sidang = $arr->row()->id;

			$data = [
				'id_ketua_sidang' => $id_ketua_sidang,
				'status_rat'      => '1',
			];

			$exec = $this->mcore->update('rat', $data, ['id' => $id_rat]);

			$data = ['id_jabatan' => '1'];

			$exec = $this->mcore->update('anggota', $data, ['id' => $id_ketua_sidang]);

			if($exec){
				$this->session->set_flashdata('success', 'Penetapan Ketua Sidang Berhasil');
			}else{
				$this->session->set_flashdata('success', 'Penetapan Ketua Sidang Gagal');
			}

			redirect('admin/rat','refresh');
		}
	}

	public function penetapan_manual($id_rat)
	{
		$data['title']       = 'Penetapan Manual Ketua Sidang';
		$data['content']     = 'rat/form_penetapan_manual';
		$data['vitamin']     = 'rat/form_penetapan_manual_vitamin';
		$max_vote            = $this->mmain->pilih_nilai_max_vote($id_rat)->row()->vote;
		$data['arr_anggota'] = $this->mmain->anggota_voter_tertinggi($id_rat, $max_vote);
		$data['id_rat']      = $id_rat;

		$this->template->template($data);
	}

	public function store_penetapan_manual()
	{
		$id_rat     = $this->input->post('id_rat');
		$id_anggota = $this->input->post('id_anggota');

		$data = [
			'id_ketua_sidang' => $id_anggota,
			'status_rat'      => '1',
		];

		$exec = $this->mcore->update('rat', $data, ['id' => $id_rat]);

		$data = ['id_jabatan' => '1'];

		$exec = $this->mcore->update('anggota', $data, ['id' => $id_anggota]);

		if($exec){
			$this->session->set_flashdata('success', 'Penetapan Ketua Sidang Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Penetapan Ketua Sidang Gagal');
		}

		redirect('admin/rat','refresh');

	}

	public function store()
	{
		$pesan_duplikat     = '<mark>Kode RAT</mark> telah digunakan!<br>Silahkan gunakan Kode RAT lainnya';
		$polling_mulai_obj  = new DateTime();
		$polling_akhir_obj  = new DateTime();
		$rat_mulai_obj      = new DateTime();
		$rat_akhir_obj      = new DateTime();
		$kode_rat           = $this->input->post('kode_rat', TRUE);
		$th_buku            = $this->input->post('th_buku', TRUE);
		$kata_pengantar     = nl2br($this->input->post('kata_pengantar', TRUE));
		$polling_mulai      = $polling_mulai_obj->createFromFormat('d-m-Y', $this->input->post('polling_mulai', TRUE))->format('Y-m-d');
		$polling_akhir      = $polling_akhir_obj->createFromFormat('d-m-Y', $this->input->post('polling_akhir', TRUE))->format('Y-m-d');
		$rat_mulai          = $rat_mulai_obj->createFromFormat('d-m-Y', $this->input->post('rat_mulai', TRUE))->format('Y-m-d');
		$rat_akhir          = $rat_akhir_obj->createFromFormat('d-m-Y', $this->input->post('rat_akhir', TRUE))->format('Y-m-d');
		$rat_mulai_temp     = $this->input->post('rat_mulai', TRUE);
		$rat_akhir_temp     = $this->input->post('rat_akhir', TRUE);
		$polling_mulai_temp = $this->input->post('polling_mulai', TRUE);
		$polling_akhir_temp = $this->input->post('polling_akhir', TRUE);
		$status_rat         = '0';

		# cek duplikat
		$count = $this->mcore->count('rat', ['kode_rat' => $kode_rat]);
		if($count > 0){
			$this->session->set_flashdata('success', $pesan_duplikat);
			$this->session->set_flashdata('kode_rat_temp', $kode_rat);
			$this->session->set_flashdata('th_buku_temp', $th_buku);
			$this->session->set_flashdata('kata_pengantar_temp', $kata_pengantar);
			$this->session->set_flashdata('rat_mulai_temp', $rat_mulai_temp);
			$this->session->set_flashdata('rat_akhir_temp', $rat_akhir_temp);
			$this->session->set_flashdata('polling_mulai_temp', $polling_mulai_temp);
			$this->session->set_flashdata('polling_akhir_temp', $polling_akhir_temp);
			redirect(site_url('admin/rat/create'), 'refresh');
			exit;
		}
		# end cek duplikat

		$data = compact('kode_rat', 'th_buku', 'kata_pengantar', 'rat_mulai', 'rat_akhir', 'status_rat', 'polling_mulai', 'polling_akhir');
		$exec = $this->mcore->store('rat', $data);

		if($exec){
			$this->session->set_flashdata('success', 'Tambah Data Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Update Data Gagal');
		}

		redirect(site_url('admin/rat/create'), 'refresh');
	}

	public function update()
	{
		$id         = $this->input->post('id_e', TRUE);
		$group_list = $this->input->post('group_list_e', TRUE);
		$id_list    = $this->input->post('id_list_e', TRUE);
		$keterangan = $this->input->post('keterangan_e', TRUE);

		$data = compact('group_list', 'id_list', 'keterangan');
		$where = ['id' => $id];
		$exec = $this->mcore->update('list_kode', $data, $where);

		if($exec){
			$this->session->set_flashdata('success', 'Update Data Berhasil');
			redirect(site_url('admin/list_kode'), 'refresh');
		}else{
			$this->session->set_flashdata('success', 'Update Data Gagal');
			redirect(site_url('admin/list_kode'), 'refresh');
		}
	}

	public function destroy($id)
	{
		$exec = $this->mmain->delete($id);

		if($exec){
			$this->session->set_flashdata('success', 'Delete Data Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Delete Data Gagal');
		}
		redirect(site_url('admin/rat'), 'refresh');
	}

	public function detail($id)
	{
		$data['cur_date']          = new DateTime();
		$data['polling_mulai_obj'] = new DateTime();
		$data['polling_akhir_obj'] = new DateTime();
		$data['rat_mulai_obj']     = new DateTime();
		$data['rat_akhir_obj']     = new DateTime();

		$data['title']             = 'Detail RAT';
		$data['content']           = 'rat/detail';
		$data['vitamin']           = 'rat/detail_vitamin';
		$data['arr']               = $this->mcore->get('rat', '*', ['id' => $id], NULL, 'ASC', NULL, NULL);
		$data['arr_jenis_laporan'] = $this->mcore->get('list_kode', '*', ['group_list' => 'jenis_laporan'], 'id_list', 'ASC', NULL, NULL);
		$data['arr_file']          = $this->mmain->get_file_info($id);
		$data['arr_anggota']       = $this->mcore->get('anggota', '*', ['id_jabatan' => '9'], 'nama', 'ASC', NULL, NULL);
		$id_login                  = $this->session->userdata(UNQ.'id');
		$data['sudah_polling']     = $this->mcore->get('anggota_polling', '*', ['id_rat' => $id, 'id_pemilih' => $id_login], NULL, 'ASC', NULL, NULL)->num_rows();

		$data['qc'] = array();
		foreach ($data['arr_anggota']->result() as $key) {
			$id_anggota = $key->id;
			$nama       = $key->nama;
			$arr_vote   = $this->mcore->get('polling', 'vote', ['id_rat' => $id, 'id_anggota' => $id_anggota], NULL, 'ASC', NULL, NULL);

			if($arr_vote->num_rows() == 0){
				$vote = 0;
			}else{
				$vote = $arr_vote->row()->vote;
			}

			$nested = [
				'nama' => $nama,
				'vote' => $vote,
			];

			$data['qc'][] = $nested;
		}

		$cur_date_obj              = new DateTime('now');
		$polling_mulai_obj         = new DateTime($data['arr']->row()->polling_mulai);
		$polling_akhir_obj         = new DateTime($data['arr']->row()->polling_akhir);


		if($cur_date_obj < $polling_mulai_obj){
			$data['bisa_polling'] = 'belum';
		}elseif($cur_date_obj > $polling_akhir_obj){
			$data['bisa_polling'] = 'berakhir';
		}else{
			$data['bisa_polling'] = 'bisa';
		}

		$this->template->template($data);
	}

	public function store_polling()
	{
		$id_rat     = $this->input->post('id_rat');
		$id_anggota = $this->input->post('id_anggota');
		$id_pemilih = $this->session->userdata(UNQ.'id');
		$id_respon  = $this->input->post('id_respon', TRUE);
		$ket_respon = trim($this->input->post('ket_respon', TRUE));

		$vote = $this->mcore->get('polling', 'vote', ['id_anggota' => $id_anggota, 'id_rat' => $id_rat], NULL, 'ASC', NULL, NULL);

		if($vote->num_rows() == 0){
			$data = [
				'id_rat'     => $id_rat,
				'id_anggota' => $id_anggota,
				'vote'       => '1'
			];
			$exec = $this->mcore->store('polling', $data);
		}else{
			$vote_baru = $vote->row()->vote + 1;
			$data      = ['vote' => $vote_baru];
			$exec      = $this->mcore->update('polling', $data, ['id_rat' => $id_rat, 'id_anggota' => $id_anggota]);
		}

		$data_anggota_polling = [
			'id_rat'     => $id_rat,
			'id_pemilih' => $id_pemilih,
			'id_pilihan' => $id_anggota,
		];

		$exec = $this->mcore->store('anggota_polling', $data_anggota_polling);

		if($exec){
			$this->session->set_flashdata('success', 'Polling Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Polling Gagal');
		}

		redirect(site_url('admin/rat/detail/'.$id_rat), 'refresh');
	}

	public function upload()
	{
		$id               = $this->input->post('id_rat_upload', TRUE);
		$id_jenis_laporan = $this->input->post('id_jenis_laporan', TRUE);
		$nama_laporan     = trim($this->input->post('nama_file', TRUE));
		$flag_respon      = $this->input->post('flag_respon', TRUE);

		# cek file ada apa engga
		$config['upload_path']   = './assets/pdf/file_rat/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']      = 50024; // 50 MB
		$config['encrypt_name']  = FALSE;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('file')){
			$data_upload  = $this->upload->data();
			$file_laporan = $data_upload['file_name'];
			$data = [
				'id_rat'           => $id,
				'id_jenis_laporan' => $id_jenis_laporan,
				'nama_laporan'     => $nama_laporan,
				'file_laporan'     => $file_laporan,
				'flag_respon'      => $flag_respon,
			];

			$exec = $this->mcore->store('file_rat', $data);

			if($exec){
				$this->session->set_flashdata('success', 'Upload Data Berhasil');
			}else{
				$this->session->set_flashdata('success', 'Upload Data Gagal');
			}

		}else{
			$this->session->set_flashdata('file_error', $this->upload->display_errors());
		}
		# end cek file ada apa engga
		
		redirect(site_url('admin/rat/detail/'.$id), 'refresh');
	}

	public function read($id_rat, $id)
	{
		$data['title']      = 'Baca File RAT';
		$data['content']    = 'rat/read';
		$data['vitamin']    = 'rat/read_vitamin';
		$data['arr_respon'] = $this->mcore->get('list_kode', '*', ['group_list' => 'respon'], NULL, 'ASC', NULL, NULL);
		$data['arr_rat']    = $this->mcore->get('rat', '*', ['id' => $id_rat], NULL, 'ASC', NULL, NULL);
		$data['arr']        = $this->mcore->get('file_rat', '*', ['id' => $id], NULL, 'ASC', NULL, NULL);

		$id_anggota     = $this->session->userdata(UNQ.'id');
		$arr_respon_res = $this->mcore->get('respon_rat', '*', ['id_anggota' => $id_anggota], NULL, 'ASC', NULL, NULL);

		$data['id_respon']  = NULL;
		$data['ket_respon'] = NULL;

		if($arr_respon_res->num_rows() == 1){
			foreach ($arr_respon_res->result() as $key) {
				$data['id_respon']  = $key->id_respon;
				$data['ket_respon'] = $key->ket_respon;
			}
		}

		$cur_date_obj  = new DateTime('now');
		$rat_mulai_obj = new DateTime($data['arr_rat']->row()->rat_mulai);
		$rat_akhir_obj = new DateTime($data['arr_rat']->row()->rat_akhir);

		if($cur_date_obj < $rat_mulai_obj){
			$data['bisa_respon'] = 'belum';
		}elseif($cur_date_obj > $rat_akhir_obj){
			$data['bisa_respon'] = 'berakhir';
		}else{
			$data['bisa_respon'] = 'bisa';
		}

		$this->template->template($data);
	}

	public function store_respon()
	{
		$id_rat      = $this->input->post('id_rat_respon');
		$id_file_rat = $this->input->post('id_file_respon');
		$id_anggota  = $this->session->userdata(UNQ.'id');
		$id_respon   = $this->input->post('id_respon', TRUE);
		$ket_respon  = trim($this->input->post('ket_respon', TRUE));

		$where_cek = [
			'id_rat'      => $id_rat, 
			'id_file_rat' => $id_file_rat,
			'id_anggota'  => $id_anggota,
		];
		$cek = $this->mcore->count('respon_rat', $where_cek);

		if($cek > 0){
			$data = [
				'id_respon'  => $id_respon,
				'ket_respon' => $ket_respon,
			];
			$exec = $this->mcore->update('respon_rat', $data, $where_cek);
		}else{
			$data = [
				'id_rat'      => $id_rat,
				'id_file_rat' => $id_file_rat,
				'id_anggota'  => $id_anggota,
				'id_respon'   => $id_respon,
				'ket_respon'  => $ket_respon,
			];
			$exec = $this->mcore->store('respon_rat', $data);
		}

		if($exec){
			$this->session->set_flashdata('success', 'Respon Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Respon Gagal');
		}

		redirect(site_url('admin/rat/read/'.$id_rat.'/'.$id_file_rat), 'refresh');
	}

	public function delete_file($id_rat, $id)
	{
		$exec = $this->mcore->delete('file_rat', ['id' => $id]);

		if($exec){
			$this->session->set_flashdata('success', 'Delete Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Delete Gagal');
		}

		redirect(site_url('admin/rat/detail/'.$id_rat), 'refresh');
	}

}

/* End of file ratController.php */
/* Location: ./application/controllers/admin/ratController.php */