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
		$data['title']         = 'Hal List RAT';
		$data['content']       = 'rat/index';
		$data['vitamin']       = 'rat/vitamin';
		$data['arr']           = $this->mmain->rat_data();
		$data['rat_mulai_obj'] = new DateTime();
		$data['rat_akhir_obj'] = new DateTime();

		$this->template->template($data);
	}

	public function aktifkan($id_rat, $aktifkan)
	{
		if($aktifkan == 'aktifkan'){
			$data = ['flag_aktif' => 'ya'];
			$pesan = 'RAT berhasil di aktifkan';
		}else{
			$data = ['flag_aktif' => 'tidak'];
			$pesan = 'RAT berhasil di non aktifkan';
		}

		$where = ['id' => $id_rat];
		$exec = $this->mcore->update('rat', $data, $where);

		if($exec){
			$this->session->set_flashdata('success', $pesan);
		}else{
			$this->session->set_flashdata('success', $pesan);
		}

		redirect(site_url('admin/rat'), 'refresh');
	}

	public function create()
	{
		$data['title']   = 'Regis RAT';
		$data['content'] = 'rat/form';
		$data['vitamin'] = 'rat/form_vitamin';

		$this->template->template($data);
	}

	public function penetapan($id_rat, $kode_rat)
	{
		# dapatkan nilai vote tertinggi di angka berapa
		$max_vote = $this->mmain->pilih_nilai_max_vote($id_rat)->row()->vote;
		# end dapatkan nilai vote tertinggi di angka berapa
		
		# dapatkan array anggota dengan voter tertinggi
		$arr = $this->mmain->anggota_voter_tertinggi($id_rat, $max_vote);
		# end dapatkan array anggota dengan voter tertinggi

		if($arr->num_rows() > 1){
			# jika jumlah anggota voter tertinggi lebih dari 1 (perolehan nilai vote sama)
			redirect('admin/rat/penetapan_manual/'.$id_rat.'/'.$kode_rat,'refresh');
			exit;
		}elseif($arr->num_rows() == 0){
			# jika semua anggota belum melakukan vote
			$this->session->set_flashdata('success', 'Penetapan tidak dapat dilakukan dikarenakan belum ada anggota yang memilih');
			redirect('admin/rat','refresh');
			exit;
		}else{
			# jika ada satu pemenang, penetapan dapat langsung dilakukan
			$id_ketua_sidang = $arr->row()->id;

			# update tabel rat
			$data = [
				'id_ketua_sidang' => $id_ketua_sidang,
				'status_rat'      => '1',
			];
			$exec1 = $this->mcore->update('rat', $data, ['id' => $id_rat]);

			# update tabel anggota
			$data = ['flag_ketua_sidang' => 'ya'];
			$exec2 = $this->mcore->update('anggota', $data, ['id' => $id_ketua_sidang]);

			if($exec1 === TRUE && $exec2 === TRUE){
				$this->session->set_flashdata('success', 'Penetapan Ketua Sidang & Pembukaan RAT '.$kode_rat.' Berhasil');
			}else{
				$this->session->set_flashdata('success', 'Penetapan Ketua Sidang & Pembukaan RAT '.$kode_rat.' Gagal');
			}

			redirect('admin/rat','refresh');
		}
	}

	public function penetapan_manual($id_rat, $kode_rat)
	{
		$data['title']       = 'Penetapan Manual Ketua Sidang RAT '.$kode_rat;
		$data['content']     = 'rat/form_penetapan_manual';
		$data['vitamin']     = 'rat/form_penetapan_manual_vitamin';
		$max_vote            = $this->mmain->pilih_nilai_max_vote($id_rat)->row()->vote;
		$data['arr_anggota'] = $this->mmain->anggota_voter_tertinggi($id_rat, $max_vote);
		$data['id_rat']      = $id_rat;
		$data['kode_rat']    = $kode_rat;

		$this->template->template($data);
	}

	public function store_penetapan_manual()
	{
		$id_rat   = $this->input->post('id_rat');
		$kode_rat = $this->input->post('kode_rat');

		$id_ketua_sidang = $this->input->post('id_anggota');

		# update tabel rat
		$data = [
			'id_ketua_sidang' => $id_ketua_sidang,
			'status_rat'      => '1',
		];
		$exec1 = $this->mcore->update('rat', $data, ['id' => $id_rat]);

		# update tabel anggota
		$data = ['flag_ketua_sidang' => 'ya'];
		$exec2 = $this->mcore->update('anggota', $data, ['id' => $id_ketua_sidang]);

		if($exec1 && $exec2){
			$this->session->set_flashdata('success', 'Penetapan Ketua Sidang & Pembukaan RAT '.$kode_rat.' Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Penetapan Ketua Sidang & Pembukaan RAT '.$kode_rat.' Gagal');
		}

		redirect('admin/rat','refresh');

	}

	public function store()
	{
		$pesan_duplikat = '<mark>Kode RAT</mark> telah digunakan!<br>Silahkan gunakan Kode RAT lainnya';
		$rat_mulai_obj  = new DateTime();
		$rat_akhir_obj  = new DateTime();
		$kode_rat       = $this->input->post('kode_rat', TRUE);
		$th_buku        = $this->input->post('th_buku', TRUE);
		$kata_pengantar = nl2br($this->input->post('kata_pengantar', TRUE));
		$rat_mulai      = $rat_mulai_obj->createFromFormat('d-m-Y', $this->input->post('rat_mulai', TRUE))->format('Y-m-d');
		$rat_akhir      = $rat_akhir_obj->createFromFormat('d-m-Y', $this->input->post('rat_akhir', TRUE))->format('Y-m-d');
		$rat_mulai_temp = $this->input->post('rat_mulai', TRUE);
		$rat_akhir_temp = $this->input->post('rat_akhir', TRUE);
		$status_rat     = '0';
		$flag_aktif     = 'tidak';

		# cek duplikat
		$count = $this->mcore->count('rat', ['kode_rat' => $kode_rat]);
		if($count > 0){
			$this->session->set_flashdata('success', $pesan_duplikat);
			$this->session->set_flashdata('kode_rat_temp', $kode_rat);
			$this->session->set_flashdata('th_buku_temp', $th_buku);
			$this->session->set_flashdata('kata_pengantar_temp', $this->input->post('kata_pengantar', TRUE));
			$this->session->set_flashdata('rat_mulai_temp', $rat_mulai_temp);
			$this->session->set_flashdata('rat_akhir_temp', $rat_akhir_temp);
			// $this->session->set_flashdata('polling_mulai_temp', $polling_mulai_temp);
			// $this->session->set_flashdata('polling_akhir_temp', $polling_akhir_temp);
			redirect(site_url('admin/rat/create'), 'refresh');
			exit;
		}
		# end cek duplikat
		

		# non aktifkan dulu flag yang aktif
		$exec = $this->mcore->update('rat', ['flag_aktif' => 'tidak'], ['flag_aktif' => 'ya']);
		# end non aktifkan dulu flag yang aktif

		$data = compact('kode_rat', 'th_buku', 'kata_pengantar', 'rat_mulai', 'rat_akhir', 'status_rat', 'flag_aktif');
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
		$rat_mulai_obj  = new DateTime();
		$rat_akhir_obj  = new DateTime();
		$id_rat         = $this->input->post('id_rat', TRUE);
		$kode_rat       = $this->input->post('kode_rat', TRUE);
		$th_buku        = $this->input->post('th_buku', TRUE);
		$kata_pengantar = nl2br($this->input->post('kata_pengantar', TRUE));
		$rat_mulai      = $rat_mulai_obj->createFromFormat('d-m-Y', $this->input->post('rat_mulai'))->format('Y-m-d');
		$rat_akhir      = $rat_akhir_obj->createFromFormat('d-m-Y', $this->input->post('rat_akhir'))->format('Y-m-d');

		$data  = compact('th_buku', 'rat_mulai', 'rat_akhir', 'kata_pengantar');
		$where = ['id' => $id_rat];
		$exec  = $this->mcore->update('rat', $data, $where);

		if($exec){
			$this->session->set_flashdata('success', 'Update Data Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Update Data Gagal');
		}

		redirect(site_url('admin/rat'), 'refresh');
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
		$data['cur_date']      = new DateTime();
		$data['rat_mulai_obj'] = new DateTime();
		$data['rat_akhir_obj'] = new DateTime();
		$id_login              = $this->session->userdata(UNQ.'id');

		$data['title']             = 'Detail RAT';
		$data['content']           = 'rat/detail';
		$data['vitamin']           = 'rat/detail_vitamin';
		$data['arr']               = $this->mcore->get('rat', '*', ['id' => $id], NULL, 'ASC', NULL, NULL);
		$data['arr_jenis_laporan'] = $this->mcore->get('list_kode', '*', ['group_list' => 'jenis_laporan'], 'id_list', 'ASC', NULL, NULL);
		$data['arr_file']          = $this->mmain->get_file_info($id);
		$data['arr_anggota']       = $this->mcore->get('anggota', '*', ['id_jabatan' => '9'], 'nama', 'ASC', NULL, NULL);
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
			if($data['arr_rat']->row()->status_rat == '0'){
				$data['bisa_respon'] = 'belum';
			}elseif($data['arr_rat']->row()->status_rat == '1'){
				$data['bisa_respon'] = 'bisa';
			}else{
				$data['bisa_respon'] = 'berakhir';
			}
		}

		if($data['arr_rat']->row()->status_rat == '0' && $this->session->userdata(UNQ.'id_jabatan') == '9' && $this->session->userdata(UNQ.'flag_ketua_sidang') == 'tidak'){
			show_error('RAT Belum dibuka<br><button type="button" onclick="window.history.back();">Kembali</button>', 500, 'Akses ditolak');
			exit;
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

	public function edit($id)
	{
		$data['title']   = 'Edit RAT';
		$data['content'] = 'rat/form_edit';
		$data['vitamin'] = 'rat/form_edit_vitamin';
		$data['arr']     = $this->mcore->get('rat', '*', ['id' => $id], NULL, 'ASC', NULL, NULL);

		$data['tgl_obj_mulai'] = new DateTime();
		$data['tgl_obj_akhir'] = new DateTime();

		$this->template->template($data);
	}

	public function pembukaan()
	{
		$data['title']             = 'Buka RAT';
		$data['content']           = 'rat/buka';
		$data['vitamin']           = 'rat/buka_vitamin';
		$data['arr']               = $this->mmain->rat_data_buka();
		$data['polling_mulai_obj'] = new DateTime();
		$data['polling_akhir_obj'] = new DateTime();
		$data['rat_mulai_obj']     = new DateTime();
		$data['rat_akhir_obj']     = new DateTime();

		$this->template->template($data);
	}

	public function vote_pengurus()
	{
		$data['title']   = 'Vote Pengurus';
		$data['content'] = 'rat/form_vote_pengurus';
		$data['vitamin'] = 'rat/form_vote_pengurus_vitamin';

		$data['rat_mulai_obj'] = new DateTime();
		$data['rat_akhir_obj'] = new DateTime();

		$data['arr']           = $this->mcore->get('rat', '*', ['flag_aktif' => 'ya'], NULL, 'ASC', NULL, NULL);
		$data['arr_anggota']   = $this->mcore->get('anggota', '*', ['id_jabatan' => '9'], 'nama', 'ASC', NULL, NULL);
		$id_login              = $this->session->userdata(UNQ.'id');
		$id_rat                = $data['arr']->row()->id;
		$data['sudah_polling'] = $this->mcore->get('anggota_polling_pengurus', '*', ['id_rat' => $id_rat, 'id_pemilih' => $id_login], NULL, 'ASC', NULL, NULL)->num_rows();

		if($data['arr']->num_rows() == 0){
			show_error('Data RAT Belum tidak ditemukan', 500, 'Akses ditolak');
			exit;
		}

		// QC KETUA PENGURUS
		$data['qc_1'] = array();
		foreach ($data['arr_anggota']->result() as $key) {
			$id_anggota = $key->id;
			$nama       = $key->nama;
			$arr_vote   = $this->mcore->get('polling_pengurus', 'vote', ['id_rat' => $data['arr']->row()->id, 'id_anggota' => $id_anggota, 'id_jabatan' => '1'], NULL, 'ASC', NULL, NULL);

			if($arr_vote->num_rows() == 0){
				$vote = 0;
			}else{
				$vote = $arr_vote->row()->vote;
			}

			$nested = [
				'nama' => $nama,
				'vote' => $vote,
			];

			$data['qc_1'][] = $nested;
		}
		$this->_array_sort_by_column($data['qc_1'], 'vote', SORT_DESC);
		// END QC KETUA PENGURUS

		// QC SEKERTARIS
		$data['qc_2'] = array();
		foreach ($data['arr_anggota']->result() as $key) {
			$id_anggota = $key->id;
			$nama       = $key->nama;
			$arr_vote   = $this->mcore->get('polling_pengurus', 'vote', ['id_rat' => $data['arr']->row()->id, 'id_anggota' => $id_anggota, 'id_jabatan' => '2'], NULL, 'ASC', NULL, NULL);

			if($arr_vote->num_rows() == 0){
				$vote = 0;
			}else{
				$vote = $arr_vote->row()->vote;
			}

			$nested = [
				'nama' => $nama,
				'vote' => $vote,
			];

			$data['qc_2'][] = $nested;
		}
		$this->_array_sort_by_column($data['qc_2'], 'vote', SORT_DESC);
		// END QC SEKERTARIS
		
		// QC BENDAHARA
		$data['qc_3'] = array();
		foreach ($data['arr_anggota']->result() as $key) {
			$id_anggota = $key->id;
			$nama       = $key->nama;
			$arr_vote   = $this->mcore->get('polling_pengurus', 'vote', ['id_rat' => $data['arr']->row()->id, 'id_anggota' => $id_anggota, 'id_jabatan' => '3'], NULL, 'ASC', NULL, NULL);

			if($arr_vote->num_rows() == 0){
				$vote = 0;
			}else{
				$vote = $arr_vote->row()->vote;
			}

			$nested = [
				'nama' => $nama,
				'vote' => $vote,
			];

			$data['qc_3'][] = $nested;
		}
		$this->_array_sort_by_column($data['qc_3'], 'vote', SORT_DESC);
		// END QC SEKERTARIS

		$this->template->template($data);
	}

	public function store_vote_pengurus()
	{
		$id_rat            = $this->input->post('id_rat');
		$id_ketua_pengurus = $this->input->post('id_ketua_pengurus');
		$id_sekertaris     = $this->input->post('id_sekertaris');
		$id_bendahara      = $this->input->post('id_bendahara');
		$id_pemilih        = $this->session->userdata(UNQ.'id');

		// VOTE KETUA PENGURUS
		$vote_ketua_pengurus = $this->mcore->get('polling_pengurus', 'vote', ['id_anggota' => $id_ketua_pengurus, 'id_rat' => $id_rat, 'id_jabatan' => '1'], NULL, 'ASC', NULL, NULL);

		if($vote_ketua_pengurus->num_rows() == 0){
			$data = [
				'id_rat'     => $id_rat,
				'id_anggota' => $id_ketua_pengurus,
				'vote'       => '1',
				'id_jabatan' => '1'
			];
			$exec = $this->mcore->store('polling_pengurus', $data);
		}else{
			$vote_baru_ketua_pengurus = $vote_ketua_pengurus->row()->vote + 1;
			$data                     = ['vote' => $vote_baru_ketua_pengurus];
			$exec                     = $this->mcore->update('polling_pengurus', $data, ['id_rat' => $id_rat, 'id_anggota' => $id_ketua_pengurus, 'id_jabatan' => '1']);
		}

		$data_anggota_polling = [
			'id_rat'     => $id_rat,
			'id_pemilih' => $id_pemilih,
			'id_pilihan' => $id_ketua_pengurus,
			'id_jabatan' => '1',
		];

		$exec = $this->mcore->store('anggota_polling_pengurus', $data_anggota_polling);
		// END VOTE KETUA PENGURUS
		
		// VOTE SEKERTARIS
		$vote_sekertaris = $this->mcore->get('polling_pengurus', 'vote', ['id_anggota' => $id_sekertaris, 'id_rat' => $id_rat, 'id_jabatan' => '2'], NULL, 'ASC', NULL, NULL);

		if($vote_sekertaris->num_rows() == 0){
			$data = [
				'id_rat'     => $id_rat,
				'id_anggota' => $id_sekertaris,
				'vote'       => '1',
				'id_jabatan' => '2'
			];
			$exec = $this->mcore->store('polling_pengurus', $data);
		}else{
			$vote_baru_sekertaris = $vote_sekertaris->row()->vote + 1;
			$data                = ['vote' => $vote_baru_sekertaris];
			$exec                = $this->mcore->update('polling_pengurus', $data, ['id_rat' => $id_rat, 'id_anggota' => $id_sekertaris, 'id_jabatan' => '2']);
		}

		$data_anggota_polling = [
			'id_rat'     => $id_rat,
			'id_pemilih' => $id_pemilih,
			'id_pilihan' => $id_sekertaris,
			'id_jabatan' => '2',
		];

		$exec = $this->mcore->store('anggota_polling_pengurus', $data_anggota_polling);
		// END VOTE SEKERTARIS
		
		// VOTE BENDAHARA
		$vote_bendahara = $this->mcore->get('polling_pengurus', 'vote', ['id_anggota' => $id_bendahara, 'id_rat' => $id_rat, 'id_jabatan' => '3'], NULL, 'ASC', NULL, NULL);

		if($vote_bendahara->num_rows() == 0){
			$data = [
				'id_rat'     => $id_rat,
				'id_anggota' => $id_bendahara,
				'vote'       => '1',
				'id_jabatan' => '3'
			];
			$exec = $this->mcore->store('polling_pengurus', $data);
		}else{
			$vote_baru_bendahara = $vote_bendahara->row()->vote + 1;
			$data                = ['vote' => $vote_baru_bendahara];
			$exec                = $this->mcore->update('polling_pengurus', $data, ['id_rat' => $id_rat, 'id_anggota' => $id_bendahara, 'id_jabatan' => '3']);
		}

		$data_anggota_polling = [
			'id_rat'     => $id_rat,
			'id_pemilih' => $id_pemilih,
			'id_pilihan' => $id_bendahara,
			'id_jabatan' => '3',
		];

		$exec = $this->mcore->store('anggota_polling_pengurus', $data_anggota_polling);
		// END VOTE BENDAHARA

		if($exec){
			$this->session->set_flashdata('success', 'Polling Berhasil');
		}else{
			$this->session->set_flashdata('success', 'Polling Gagal');
		}

		redirect(site_url('admin/rat/vote_pengurus'), 'refresh');
	}

	public function _array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}

		array_multisort($sort_col, $dir, $arr);
	}

	public function penutupan()
	{
		$data['title']             = 'Penutupan RAT';
		$data['content']           = 'rat/form_penutupan';
		$data['vitamin']           = 'rat/form_penutupan_vitamin';
		$data['id_rat']            = $this->mcore->get('rat', '*', ['flag_aktif' => 'ya'], NULL, 'ASC', NULL, NULL)->row()->id;
		$data['res_pengurus']      = $this->mmain->get_vote_pengurus();
		$data['arr_jenis_laporan'] = $this->mcore->get('list_kode', '*', ['group_list' => 'jenis_laporan'], 'id_list', 'ASC', NULL, NULL);
		$data['arr_file']          = $this->mmain->get_file_info($data['id_rat']);

		$this->template->template($data);
	}

	public function store_penutupan()
	{
		$id_rat                = $this->input->post('id_rat');
		$id_new_ketua_pengurus = $this->input->post('id_ketua_pengurus');
		$id_new_sekertaris     = $this->input->post('id_sekertaris');
		$id_new_bendahara      = $this->input->post('id_bendahara');
		$berita_acara          = nl2br(trim($this->input->post('berita_acara', TRUE)));

		$arr_prev_pengurus = $this->mmain->get_prev_pengurus();

		foreach ($arr_prev_pengurus->result() as $key) {
			if($key->id_jabatan == '1'){
				$id_prev_ketua_pengurus = $key->id;
			}elseif($key->id_jabatan == '2'){
				$id_prev_sekertaris = $key->id;
			}elseif($key->id_jabatan == '3'){
				$id_prev_bendahara = $key->id;
			}
		}

		$this->db->trans_begin();

		# UPDATE TABEL RAT
		$data  = [
			'status_rat'             => '2',
			'flag_aktif'             => 'tidak',
			'berita_acara'           => $berita_acara,
			'id_prev_ketua_pengurus' => $id_prev_ketua_pengurus,
			'id_prev_sekertaris'     => $id_prev_sekertaris,
			'id_prev_bendahara'      => $id_prev_bendahara,
			'id_new_ketua_pengurus'  => $id_new_ketua_pengurus,
			'id_new_sekertaris'      => $id_new_sekertaris,
			'id_new_bendahara'       => $id_new_bendahara,
		];

		$where = ['id' => $id_rat];
		$exec1  = $this->mcore->update('rat', $data, $where);
		# UPDATE TABEL RAT
		
		# NON AKTIF KETUA PENGURUS
		$data  = ['id_jabatan' => '9'];
		$where = ['id_jabatan' => '1'];
		$exec2 = $this->mcore->update('anggota', $data, $where);
		# NON AKTIF KETUA PENGURUS
		
		# NON AKTIF SEKERTARIS
		$data  = ['id_jabatan' => '9'];
		$where = ['id_jabatan' => '2'];
		$exec3 = $this->mcore->update('anggota', $data, $where);
		# NON AKTIF SEKERTARIS
		
		# NON AKTIF BENDAHARA
		$data  = ['id_jabatan' => '9'];
		$where = ['id_jabatan' => '3'];
		$exec4 = $this->mcore->update('anggota', $data, $where);
		# NON AKTIF BENDAHARA
		
		# PELANTIKAN KETUA PENGURUS
		$data  = ['id_jabatan' => '1'];
		$where = ['id' => $id_new_ketua_pengurus];
		$exec5 = $this->mcore->update('anggota', $data, $where);
		# NON AKTIF KETUA PENGURUS
		
		# PELANTIKAN SEKERTARIS
		$data  = ['id_jabatan' => '2'];
		$where = ['id' => $id_new_sekertaris];
		$exec6 = $this->mcore->update('anggota', $data, $where);
		# NON AKTIF KETUA PENGURUS
		
		# PELANTIKAN BENDAHARA
		$data  = ['id_jabatan' => '3'];
		$where = ['id' => $id_new_bendahara];
		$exec7 = $this->mcore->update('anggota', $data, $where);
		# NON AKTIF KETUA PENGURUS

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_flashdata('success', 'Penutupan RAT Berhasil');
		}else{
			$this->db->trans_commit();
			$this->session->set_flashdata('success', 'Penutupan RAT Gagal');
		}

		redirect(site_url('admin/rat'), 'refresh');

	}

}

/* End of file ratController.php */
/* Location: ./application/controllers/admin/ratController.php */