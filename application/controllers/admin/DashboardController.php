<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
	}

	public function index()
	{
		$data['title']   = 'Dashboard';
		$data['content'] = 'dashboard/index';
		$data['vitamin'] = 'dashboard/vitamin';

		$this->template->template($data);
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

/* End of file DashboardController.php */
/* Location: ./application/controllers/admin/DashboardController.php */