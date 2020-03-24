<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAdminModel extends CI_Model {

	public function get_user_info($username)
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
			anggota.flag_ketua_sidang,
			list_kode.keterangan as nama_jabatan
		');
		$this->db->join('list_kode', 'list_kode.group_list = \'jabatan\' AND list_kode.id_list = anggota.id_jabatan', 'left');
		$this->db->where('user_login', $username);
		return $this->db->get('anggota');
	}

	

}

/* End of file LoginAdminModel.php */
/* Location: ./application/models/LoginAdminModel.php */