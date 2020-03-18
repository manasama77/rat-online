<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TemplateAdmin
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('M_core', 'mcore');
	}

	public function template($data)
	{
		if(
			!$this->ci->session->userdata(UNQ.'id') && 
			!$this->ci->session->userdata(UNQ.'id_jabatan') && 
			!$this->ci->session->userdata(UNQ.'user_login') && 
			!$this->ci->session->userdata(UNQ.'nama') &&
			!$this->ci->session->userdata(UNQ.'nama_jabatan')
		){
			redirect('logout/admin');
		}else{
			$data['pp']   = base_url().'assets/img/avatars/avatar_default.png';
			$data['uri2'] = $this->ci->uri->segment(2);
			$data['uri3'] = $this->ci->uri->segment(3);

			if(file_exists(APPPATH.'views/admin/'.$data['content'].'.php')){
				$this->ci->load->view('layouts/admin/template', $data, FALSE);
			}else{
				show_404();
			}
		}
	}
}

/* End of file TemplateAdmin.php */
/* Location: ./application/libraries/TemplateAdmin.php */
