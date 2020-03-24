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
			rat.flag_aktif,
			anggota.nama
		');
		$this->db->join('anggota', 'anggota.id = rat.id_ketua_sidang', 'left');
		$this->db->order_by('id', 'desc');
		return $this->db->get('rat');
	}

	public function rat_data_buka()
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
			rat.flag_aktif,
			anggota.nama
		');
		$this->db->join('anggota', 'anggota.id = rat.id_ketua_sidang', 'left');
		$this->db->where('rat.status_rat', '0');
		$this->db->order_by('id', 'desc');
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

	public function get_vote_pengurus()
	{
		$ketua_pengurus_id   = NULL;
		$ketua_pengurus_nama = NULL;
		$ketua_pengurus_vote = 0;
		$sekertaris_id       = NULL;
		$sekertaris_nama     = NULL;
		$sekertaris_vote     = 0;
		$bendahara_id        = NULL;
		$bendahara_nama      = NULL;
		$bendahara_vote      = 0;

		// GET ID RAT AKTIF
		$this->db->select('id');
		$this->db->where('flag_aktif', 'ya');
		$arr_rat = $this->db->get('rat');

		$id_rat = $arr_rat->row()->id;

		// COUNT PENGURUS
		$this->db->select('polling_pengurus.id_anggota, anggota.nama, polling_pengurus.vote');
		$this->db->join('anggota', 'anggota.id = polling_pengurus.id_anggota', 'left');
		$this->db->where('polling_pengurus.id_rat', $id_rat);
		$this->db->where('polling_pengurus.id_jabatan', '1');
		$arr_ketua_pengurus  = $this->db->get('polling_pengurus', 1, 0);
		$count_ketua = $arr_ketua_pengurus->num_rows();

		if($count_ketua > 0){
			$ketua_pengurus_id   = $arr_ketua_pengurus->row()->id_anggota;
			$ketua_pengurus_nama = $arr_ketua_pengurus->row()->nama;
			$ketua_pengurus_vote = $arr_ketua_pengurus->row()->vote;
		}

		// COUNT SEKERTARIS
		$this->db->select('polling_pengurus.id_anggota, anggota.nama, polling_pengurus.vote');
		$this->db->join('anggota', 'anggota.id = polling_pengurus.id_anggota', 'left');
		$this->db->where('polling_pengurus.id_rat', $id_rat);
		$this->db->where('polling_pengurus.id_jabatan', '2');
		$arr_sekertaris  = $this->db->get('polling_pengurus', 1, 0);
		$count_sekertaris = $arr_sekertaris->num_rows();

		if($count_ketua > 0){
			$sekertaris_id   = $arr_sekertaris->row()->id_anggota;
			$sekertaris_nama = $arr_sekertaris->row()->nama;
			$sekertaris_vote = $arr_sekertaris->row()->vote;
		}
		

		// COUNT BENDAHARA
		$this->db->select('polling_pengurus.id_anggota, anggota.nama, polling_pengurus.vote');
		$this->db->join('anggota', 'anggota.id = polling_pengurus.id_anggota', 'left');
		$this->db->where('polling_pengurus.id_rat', $id_rat);
		$this->db->where('polling_pengurus.id_jabatan', '3');
		$arr_bendahara  = $this->db->get('polling_pengurus', 1, 0);
		$count_bendahara = $arr_bendahara->num_rows();

		if($count_ketua > 0){
			$bendahara_id   = $arr_bendahara->row()->id_anggota;
			$bendahara_nama = $arr_bendahara->row()->nama;
			$bendahara_vote = $arr_bendahara->row()->vote;
		}

		return compact('ketua_pengurus_id', 'ketua_pengurus_nama', 'ketua_pengurus_vote', 'sekertaris_id', 'sekertaris_nama', 'sekertaris_vote', 'bendahara_id', 'bendahara_nama', 'bendahara_vote');
	}

	public function get_prev_pengurus()
	{
		$this->db->where('id_jabatan', '1');
		$this->db->or_where('id_jabatan', '2');
		$this->db->or_where('id_jabatan', '3');
		return $this->db->get('anggota');
	}

}

/* End of file RATModel.php */
/* Location: ./application/models/RATModel.php */