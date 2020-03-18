<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RatController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
		// $this->load->model('AnggotaAdminModel', 'mmain');
	}

	public function index()
	{
		$data['title']         = 'Hal List RAT';
		$data['content']       = 'rat/index';
		$data['vitamin']       = 'rat/vitamin';
		$data['arr']           = $this->mcore->get('rat', '*', NULL, NULL, 'ASC', NULL, NULL);
		$data['rat_mulai_obj'] = new DateTime();
		$data['rat_akhir_obj'] = new DateTime();

		$this->template->template($data);
	}

	public function create()
	{
		$data['title']         = 'Regis RAT';
		$data['content']       = 'rat/form';
		$data['vitamin']       = 'rat/form_vitamin';

		$this->template->template($data);

	}

	public function store()
	{
		$pesan_duplikat = '<mark>Kode RAT</mark> telah digunakan!<br>Silahkan gunakan Kode RAT lainnya';
		$rat_mulai_obj  = new DateTime();
		$rat_akhir_obj  = new DateTime();
		$kode_rat       = $this->input->post('kode_rat', TRUE);
		$th_buku        = $this->input->post('th_buku', TRUE);
		$kata_pengantar = $this->input->post('kata_pengantar', TRUE);
		$rat_mulai      = $rat_mulai_obj->createFromFormat('d-m-Y', $this->input->post('rat_mulai', TRUE))->format('Y-m-d');
		$rat_akhir      = $rat_akhir_obj->createFromFormat('d-m-Y', $this->input->post('rat_akhir', TRUE))->format('Y-m-d');
		$rat_mulai_temp = $this->input->post('rat_mulai', TRUE);
		$rat_akhir_temp = $this->input->post('rat_akhir', TRUE);
		$status_rat     = '0';

		# cek duplikat
		$count = $this->mcore->count('rat', ['kode_rat' => $kode_rat]);
		if($count > 0){
			$this->session->set_flashdata('success', $pesan_duplikat);
			$this->session->set_flashdata('kode_rat_temp', $kode_rat);
			$this->session->set_flashdata('th_buku_temp', $th_buku);
			$this->session->set_flashdata('kata_pengantar_temp', $kata_pengantar);
			$this->session->set_flashdata('rat_mulai_temp', $rat_mulai_temp);
			$this->session->set_flashdata('rat_akhir_temp', $rat_akhir_temp);
			redirect(site_url('admin/rat/create'), 'refresh');
			exit;
		}
		# end cek duplikat

		$data = compact('kode_rat', 'th_buku', 'kata_pengantar', 'rat_mulai', 'rat_akhir', 'status_rat');
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
		$exec = $this->mcore->delete('list_kode', ['id' => $id]);

		if($exec){
			$this->session->set_flashdata('success', 'Delete Data Berhasil');
			redirect(site_url('admin/list_kode'), 'refresh');
		}else{
			$this->session->set_flashdata('success', 'Delete Data Gagal');
			redirect(site_url('admin/list_kode'), 'refresh');
		}
	}

	public function detail($id)
	{
		$data['title']         = 'Detail RAT';
		$data['content']       = 'rat/detail';
		$data['vitamin']       = 'rat/detail_vitamin';
		$data['arr']           = $this->mcore->get('rat', '*', ['id' => $id], NULL, 'ASC', NULL, NULL);
		$data['rat_mulai_obj'] = new DateTime();
		$data['rat_akhir_obj'] = new DateTime();

		$this->template->template($data);
	}

}

/* End of file ratController.php */
/* Location: ./application/controllers/admin/ratController.php */