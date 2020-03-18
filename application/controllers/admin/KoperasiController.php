<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KoperasiController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
	}

	public function index()
	{
		$data['title']     = 'Data Koperasi';
		$data['content']   = 'koperasi/index';
		$data['vitamin']   = 'koperasi/vitamin';

		$arr = $this->mcore->get('koperasi', '*', ['id' => '1'], NULL, 'ASC', NULL, NULL);

		$data['nama_koperasi'] = $arr->row()->nama_koperasi;
		$data['alamat']        = $arr->row()->alamat;
		$data['no_telp']       = $arr->row()->no_telp;
		$data['nik']           = $arr->row()->nik;

		$this->template->template($data);
	}

	public function update()
	{
		$nama_koperasi = $this->input->post('nama_koperasi', TRUE);
		$alamat        = $this->input->post('alamat', TRUE);
		$no_telp       = $this->input->post('no_telp', TRUE);
		$nik           = $this->input->post('nik', TRUE);

		$data  = compact('nama_koperasi', 'alamat', 'no_telp', 'nik');
		$where = ['id' => 1];

		$exec = $this->mcore->update('koperasi', $data, $where);

		if($exec){
			$this->session->set_flashdata('success', 'Update Data Koperasi Berhasil');
			redirect(site_url('admin/koperasi'), 'refresh');
		}else{
			$this->session->set_flashdata('success', 'Update Data Koperasi Gagal');
			redirect(site_url('admin/koperasi'), 'refresh');
		}
	}

	public function init()
	{
		$start = '2020-01-01';
		$end   = '2020-01-31';

		$data = [
			'periode_start' => $start,
			'periode_end'   => $end,
			'flag_aktif'    => 'aktif'
		];

		$exec = $this->mcore->store_uuid('app_periode_po', $data);

		if($exec){
			echo "berhasil";
		}else{
			echo "gagal";
		}
	}

}

/* End of file KoperasiController.php */
/* Location: ./application/controllers/admin/KoperasiController.php */