<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListKodeController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
	}

	public function index()
	{
		$data['title']   = 'List Kode';
		$data['content'] = 'list_kode/index';
		$data['vitamin'] = 'list_kode/vitamin';
		$data['arr']     = $this->mcore->get('list_kode', '*', NULL, 'group_list', 'ASC', NULL, NULL);

		$this->template->template($data);
	}

	public function store()
	{
		$pesan_duplikat = '<mark>Group List</mark> & <mark>ID List</mark> telah terdaftar!<br>Silahkan pilih Group List lainnya atau gunakan ID List lainnya';
		$group_list = $this->input->post('group_list', TRUE);
		$id_list    = $this->input->post('id_list', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);

		# cek duplikat
		$count = $this->mcore->count('list_kode', ['group_list' => $group_list, 'id_list' => $id_list]);
		if($count > 0){
			$this->session->set_flashdata('success', $pesan_duplikat);
			$this->session->set_flashdata('group_list_temp', $group_list);
			$this->session->set_flashdata('id_list_temp', $id_list);
			$this->session->set_flashdata('keterangan_temp', $keterangan);
			redirect(site_url('admin/list_kode'), 'refresh');
			exit;
		}
		# end cek duplikat

		$data = compact('group_list', 'id_list', 'keterangan');
		$exec = $this->mcore->store('list_kode', $data);

		if($exec){
			$this->session->set_flashdata('success', 'Tambah Data Berhasil');
			redirect(site_url('admin/list_kode'), 'refresh');
		}else{
			$this->session->set_flashdata('success', 'Update Data Gagal');
			redirect(site_url('admin/list_kode'), 'refresh');
		}
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

}

/* End of file ListKodeController.php */
/* Location: ./application/controllers/admin/ListKodeController.php */