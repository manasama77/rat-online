<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaAdminModel extends CI_Model {

	public function get_list_anggota()
	{
		$this->db->select('
			anggota.id,
			anggota.nama, 
			anggota.tempat_lahir,
			anggota.tanggal_lahir,
			anggota.jenis_kelamin, 
			anggota.no_ktp, 
			anggota.alamat, 
			anggota.no_telp, 
			anggota.foto, 
			anggota.user_login, 
			anggota.id_jabatan, 
			list_kode.keterangan AS nama_jabatan
		');
		$this->db->join('list_kode', 'list_kode.id_list = anggota.id_jabatan AND list_kode.group_list = \'jabatan\'', 'left');
		return $this->db->get('anggota');
	}

	

}

/* End of file AnggotaAdminModel.php */
/* Location: ./application/models/AnggotaAdminModel.php */