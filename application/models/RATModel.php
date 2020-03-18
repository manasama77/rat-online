<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RATModel extends CI_Model {

	public function rat_data()
	{
		$this->db->select('
			rat.id,
			rat.kode_rat,
			rat.th_buku,
			rat.rat_mulai,
			rat.rat_akhir,
			rat.id_ketua_sidang,
			rat.kata_pengantar,
			rat.status_rat,
			rat.polling_mulai,
			rat.polling_akhir,
			anggota.nama
		');
		$this->db->join('anggota', 'anggota.id = rat.id_ketua_sidang', 'left');
		return $this->db->get('rat');
	}

	public function pilih_nilai_max_vote($id_rat)
	{
		$this->db->select_max('vote');
		$this->db->where('id_rat', $id_rat);
		return $this->db->get('polling');
	}

	public function anggota_voter_tertinggi($id_rat, $max_vote)
	{
		$this->db->select('
			anggota.id,
			anggota.nama,
		');
		$this->db->join('anggota', 'anggota.id = polling.id_anggota', 'left');
		$this->db->where('polling.id_rat', $id_rat);
		$this->db->where('polling.vote', $max_vote);
		return $this->db->get('polling');
	}

	public function get_file_info($id_rat)
	{
		$this->db->select("
			file_rat.id,
			file_rat.id_rat,
			file_rat.id_jenis_laporan,
			file_rat.nama_laporan,
			file_rat.file_laporan,
			file_rat.flag_respon,
			jenis_laporan.keterangan as jenis_laporan,
			(select count(*) from respon_rat where id_rat = file_rat.id_rat and id_respon = '1') as setuju,
			(select count(*) from respon_rat where id_rat = file_rat.id_rat and id_respon = '2') as menolak,
			(select count(*) from respon_rat where id_rat = file_rat.id_rat and id_respon = '3') as abstain,
			(
				IF(
					(select count(*) from respon_rat where id_rat = file_rat.id_rat) = 0,
					(select count(*) from anggota where id_jabatan = '9'),
					(select count(*) from anggota where id_jabatan = '9') - (select count(*) from respon_rat where id_rat = file_rat.id_rat)
				)
			) as belum_menilai
		");
		$this->db->join('list_kode as jenis_laporan', 'jenis_laporan.id_list = file_rat.id_jenis_laporan AND jenis_laporan.group_list = \'jenis_laporan\'', 'left');
		$this->db->where('file_rat.id_rat', $id_rat);
		return $this->db->get('file_rat');
	}

	public function delete($id_rat)
	{
		$this->db->where('id_rat', $id_rat);
		$this->db->delete('anggota_polling');

		$this->db->where('id_rat', $id_rat);
		$this->db->delete('file_rat');

		$this->db->where('id_rat', $id_rat);
		$this->db->delete('file_rat');

		$this->db->where('id_rat', $id_rat);
		$this->db->delete('polling');

		$this->db->where('id', $id_rat);
		$this->db->delete('rat');

		$this->db->where('id_rat', $id_rat);
		$this->db->delete('respon_rat');

		return TRUE;
	}

}

/* End of file RATModel.php */
/* Location: ./application/models/RATModel.php */